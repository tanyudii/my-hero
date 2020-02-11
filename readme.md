## Core (SmoothSystem™)

## [Important Publish]
- smoothsystem-config
- smoothsystem-migration

## [Additional Publish]
- smoothsystem-seed
- smoothsystem-factories

## Installation Authorizations
- Set register authorization to true in config smoothsystem.authorization
- Register middleware 'smoothsystem.gate' => \Smoothsystem\Core\Http\Middleware\Gate::class

## Installation Instructions
- Delete migration default (users, failed_jobs, jobs);
- Register seeds (users, roles, role_users in DatabaseSeeder)
- Factory model namespace location "Smoothsystem\Core\Entities"

## Api Settings
- Custom factory Eloquent location in config smoothsystem.models
- Passport able to custom in config  smoothsystem.passport
- For project use Passport, setting user guards in config auth.guards.api.driver to 'passport'
