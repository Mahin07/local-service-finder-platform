# Changelog

All notable changes to ServiceFinder are documented in this file.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and this project follows [Semantic Versioning](https://semver.org/).

## [Unreleased]

### Added

- GitHub Actions continuous-integration workflow.
- Dependabot configuration for Composer and GitHub Actions.
- Repository contribution and security-reporting guidance.
- Database indexes for common service-directory and booking queries.

### Changed

- Provider profile statistics now use database aggregates instead of loading complete collections.
- Public dashboard and service-directory queries fetch only the columns rendered by the UI.
