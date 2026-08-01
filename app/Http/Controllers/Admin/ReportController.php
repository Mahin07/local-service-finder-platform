<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'fromDate' => ['nullable', 'date'],
            'toDate' => ['nullable', 'date', 'after_or_equal:fromDate'],
            'category' => ['nullable', 'integer', 'min:1'],
            'export' => ['nullable', 'boolean'],
        ]);

        $servicesHasCategoryId = Schema::hasColumn('services', 'category_id');
        $hasCategoriesTable = Schema::hasTable('categories');

        $query = DB::table('bookings')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('providers', 'bookings.provider_id', '=', 'providers.id')
            ->leftJoin('services', 'bookings.service_id', '=', 'services.id');

        if ($servicesHasCategoryId && $hasCategoriesTable) {
            $query->leftJoin('categories', 'services.category_id', '=', 'categories.id');
        }

        $query->select(
            'bookings.*',
            'users.name as user_name',
            'users.email as user_email',
            'providers.name as provider_name',
            DB::raw("COALESCE(services.name, 'Service') as service_name"),
            DB::raw($servicesHasCategoryId && $hasCategoriesTable
                ? "COALESCE(categories.name, 'Uncategorized') as cat_name"
                : "COALESCE(services.name, 'Uncategorized') as cat_name")
        );

        if ($filters['fromDate'] ?? false) {
            $query->whereDate('bookings.booking_date', '>=', $filters['fromDate']);
        }
        if ($filters['toDate'] ?? false) {
            $query->whereDate('bookings.booking_date', '<=', $filters['toDate']);
        }
        if ($filters['category'] ?? false) {
            if ($servicesHasCategoryId && $hasCategoriesTable) {
                $query->where('categories.id', $filters['category']);
            } else {
                $query->where('services.id', $filters['category']);
            }
        }

        $bookings = $query->latest('bookings.created_at')->get();

        if ($request->boolean('export')) {
            return $this->exportExcel($bookings);
        }

        // Stats
        $totalUsers = DB::table('users')->count();
        $totalProviders = DB::table('providers')->count();
        $totalBookings = DB::table('bookings')->count();
        $approvedCount = DB::table('bookings')->where('status', 'approved')->count();

        // Charts Data
        $statusData = DB::table('bookings')->select('status', DB::raw('count(*) as count'))->groupBy('status')->get();
        $monthlyData = DB::table('bookings')
            ->select(DB::raw('MONTH(booking_date) as month'), DB::raw('count(*) as total'))
            ->groupBy('month')->get();

        $allCategories = $servicesHasCategoryId && $hasCategoriesTable
            ? DB::table('categories')->get()
            : DB::table('services')->select('id', 'name')->get();

        return view('admin.report', compact('bookings', 'totalUsers', 'totalProviders', 'totalBookings', 'approvedCount', 'statusData', 'monthlyData', 'allCategories'));
    }

    private function exportExcel($data): StreamedResponse
    {
        $filename = 'Helphub_Report_'.date('d-m-y').'.xls';

        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Cache-Control' => 'max-age=0',
            'Pragma' => 'public',
        ];

        return response()->stream(function () use ($data) {
            $xml = static fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES | ENT_XML1, 'UTF-8');

            echo '<?xml version="1.0" encoding="UTF-8"?>';
            echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"';
            echo ' xmlns:o="urn:schemas-microsoft-com:office:office"';
            echo ' xmlns:x="urn:schemas-microsoft-com:office:excel"';
            echo ' xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">';
            echo '<Styles>';
            echo '<Style ss:ID="Header"><Font ss:Bold="1"/></Style>';
            echo '<Style ss:ID="Text"><NumberFormat ss:Format="@"/></Style>';
            echo '</Styles>';
            echo '<Worksheet ss:Name="Reports"><Table>';

            echo '<Row>';
            foreach (['ID', 'Customer', 'Provider', 'Service', 'Category', 'Date', 'Status'] as $heading) {
                echo '<Cell ss:StyleID="Header"><Data ss:Type="String">'.$xml($heading).'</Data></Cell>';
            }
            echo '</Row>';

            foreach ($data as $row) {
                echo '<Row>';
                echo '<Cell><Data ss:Type="Number">'.$xml($row->id).'</Data></Cell>';
                echo '<Cell><Data ss:Type="String">'.$xml($row->user_name).'</Data></Cell>';
                echo '<Cell><Data ss:Type="String">'.$xml($row->provider_name).'</Data></Cell>';
                echo '<Cell><Data ss:Type="String">'.$xml($row->service_name ?: 'Service').'</Data></Cell>';
                echo '<Cell><Data ss:Type="String">'.$xml($row->cat_name).'</Data></Cell>';
                echo '<Cell ss:StyleID="Text"><Data ss:Type="String">'.$xml(Carbon::parse($row->booking_date)->format('d-m-Y')).'</Data></Cell>';
                echo '<Cell><Data ss:Type="String">'.$xml($row->status).'</Data></Cell>';
                echo '</Row>';
            }

            echo '</Table></Worksheet></Workbook>';
        }, 200, $headers);
    }
}
