# Graph Report - growlytics  (2026-11-08)

## Corpus Check
- 48 files · ~15,922 words
- Verdict: corpus is large enough that graph structure adds value.
- Unclassified: 21 file(s) not represented in the graph (top: (none) 17, .example 1, .xml 1)

## Summary
- 335 nodes · 481 edges · 26 communities (10 shown, 16 thin omitted)
- Extraction: 96% EXTRACTED · 4% INFERRED · 0% AMBIGUOUS · INFERRED: 21 edges (avg confidence: 0.85)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `1239ed3d`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Illuminate\Database\Schema\Blueprint
- composer.json
- Item
- package.json
- bootstrap/app.php
- StreamGrowtopiaListings.php
- ListingIngestService
- config
- AppServiceProvider
- ListingIngestServiceTest
- Laravel Boost Guidelines
- README.md
- SseParser
- Controller.php

## God Nodes (most connected - your core abstractions)
1. `SseParser` - 29 edges
2. `ListingIngestService` - 18 edges
3. `SseParserTest` - 17 edges
4. `ListingIngestServiceTest` - 16 edges
5. `StreamGrowtopiaListings` - 15 edges
6. `Item` - 9 edges
7. `Listing` - 9 edges
8. `require-dev` - 9 edges
9. `scripts` - 9 edges
10. `GrowlyticsStreamCommandTest` - 9 edges

## Surprising Connections (you probably didn't know these)
- `StreamGrowtopiaListings` --references--> `ListingIngestService`  [EXTRACTED]
  app/Console/Commands/StreamGrowtopiaListings.php → app/Services/ListingIngestService.php
- `ExampleTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/ExampleTest.php → tests/TestCase.php
- `GrowlyticsStreamCommandTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/GrowlyticsStreamCommandTest.php → tests/TestCase.php
- `ListingIngestServiceTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/ListingIngestServiceTest.php → tests/TestCase.php

## Import Cycles
- None detected.

## Communities (26 total, 16 thin omitted)

### Community 0 - "Illuminate\Database\Schema\Blueprint"
Cohesion: 0.12
Nodes (10): {closure#1}(), {closure#2}(), {closure#3}(), {closure#1}(), {closure#2}(), {closure#1}(), {closure#2}(), {closure#3}() (+2 more)

### Community 1 - "composer.json"
Cohesion: 0.05
Nodes (41): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+33 more)

### Community 2 - "Item"
Cohesion: 0.09
Nodes (7): Item, Listing, User, ItemFactory, ListingFactory, UserFactory, DatabaseSeeder

### Community 3 - "package.json"
Cohesion: 0.10
Nodes (20): devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite, optionalDependencies, @laravel/multiplex (+12 more)

### Community 4 - "bootstrap/app.php"
Cohesion: 0.33
Nodes (3): {closure#1}(), {closure#2}(), {closure#3}()

### Community 7 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 9 - "ListingIngestServiceTest"
Cohesion: 0.09
Nodes (4): ExampleTest, GrowlyticsStreamCommandTest, ListingIngestServiceTest, TestCase

### Community 10 - "Laravel Boost Guidelines"
Cohesion: 0.07
Nodes (26): APIs & Eloquent Resources, Application Structure & Architecture, Artisan, Conventions, Deployment, Do Things the Laravel Way, Documentation Files, Foundational Context (+18 more)

### Community 11 - "README.md"
Cohesion: 0.14
Nodes (13): About Laravel, Agentic Development, Code of Conduct, Configuration, Contributing, Growlytics — SSE Data Ingestion, How duplicates are prevented, Known limitations (+5 more)

### Community 16 - "SseParser"
Cohesion: 0.15
Nodes (3): SseParser, ExampleTest, SseParserTest

## Knowledge Gaps
- **3 isolated node(s):** `concurrently`, `tailwindcss`, `@laravel/multiplex`
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 150 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **16 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `SseParser` connect `SseParser` to `StreamGrowtopiaListings.php`, `ListingIngestService`?**
  _High betweenness centrality (0.068) - this node is a cross-community bridge._
- **What connects `concurrently`, `tailwindcss`, `@laravel/multiplex` to the rest of the system?**
  _3 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Illuminate\Database\Schema\Blueprint` be split into smaller, more focused modules?**
  _Cohesion score 0.11904761904761904 - nodes in this community are weakly interconnected._
- **Why does `ListingIngestService` connect `ListingIngestService` to `ListingIngestServiceTest`, `StreamGrowtopiaListings.php`?**
  _High betweenness centrality (0.063) - this node is a cross-community bridge._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.047619047619047616 - nodes in this community are weakly interconnected._
- **Should `Item` be split into smaller, more focused modules?**
  _Cohesion score 0.08677098150782361 - nodes in this community are weakly interconnected._
- **Should `package.json` be split into smaller, more focused modules?**
  _Cohesion score 0.09956709956709957 - nodes in this community are weakly interconnected._