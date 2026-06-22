# Context

## Terms

- **Seeder discovery module**: finds seeder classes from configured `seeder_directories`.
- **Seed run module**: decides which seeders are pending, assigns the next batch, runs them, and records seed history.
- **Seed class resolution module**: resolves the class passed to `db:seed`, including the package fallback to `DatabaseSeederVersion`.
