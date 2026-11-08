# Graph Report - growlytics  (2026-11-08)

## Corpus Check
- 35 files · ~11,056 words
- Verdict: corpus is large enough that graph structure adds value.
- Unclassified: 21 file(s) not represented in the graph (top: (none) 17, .example 1, .xml 1)

## Summary
- 202 nodes · 210 edges · 27 communities (10 shown, 17 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `2d120921`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Illuminate\Database\Schema\Blueprint
- composer.json
- User
- package.json
- bootstrap/app.php
- require-dev
- scripts
- config
- AppServiceProvider
- TestCase
- Laravel Boost Guidelines
- README.md
- UserFactory.php
- Laravel Boost
- ExampleTest
- Controller.php

## God Nodes (most connected - your core abstractions)
1. `require-dev` - 9 edges
2. `scripts` - 9 edges
3. `User` - 8 edges
4. `Laravel Boost Guidelines` - 8 edges
5. `Laravel Boost` - 6 edges
6. `AppServiceProvider` - 5 edges
7. `config` - 5 edges
8. `UserFactory` - 5 edges
9. `Do Things the Laravel Way` - 5 edges
10. `require` - 4 edges

## Surprising Connections (you probably didn't know these)
- `ExampleTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/ExampleTest.php → tests/TestCase.php

## Import Cycles
- None detected.

## Communities (27 total, 17 thin omitted)

### Community 0 - "Illuminate\Database\Schema\Blueprint"
Cohesion: 0.16
Nodes (8): {closure#1}(), {closure#2}(), {closure#3}(), {closure#1}(), {closure#2}(), {closure#1}(), {closure#2}(), {closure#3}()

### Community 1 - "composer.json"
Cohesion: 0.08
Nodes (23): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+15 more)

### Community 3 - "package.json"
Cohesion: 0.10
Nodes (20): devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite, optionalDependencies, @laravel/multiplex (+12 more)

### Community 4 - "bootstrap/app.php"
Cohesion: 0.33
Nodes (3): {closure#1}(), {closure#2}(), {closure#3}()

### Community 5 - "require-dev"
Cohesion: 0.22
Nodes (9): require-dev, fakerphp/faker, laravel/boost, laravel/pail, laravel/pao, laravel/pint, mockery/mockery, nunomaduro/collision (+1 more)

### Community 6 - "scripts"
Cohesion: 0.22
Nodes (9): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+1 more)

### Community 7 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 10 - "Laravel Boost Guidelines"
Cohesion: 0.10
Nodes (19): APIs & Eloquent Resources, Application Structure & Architecture, Conventions, Deployment, Do Things the Laravel Way, Documentation Files, Foundational Context, Frontend Bundling (+11 more)

### Community 11 - "README.md"
Cohesion: 0.25
Nodes (7): About Laravel, Agentic Development, Code of Conduct, Contributing, Learning Laravel, License, Security Vulnerabilities

### Community 14 - "Laravel Boost"
Cohesion: 0.29
Nodes (7): Artisan, Laravel Boost, Project Rules, Search Syntax, Searching Documentation (IMPORTANT), Tinker, Tools

## Knowledge Gaps
- **3 isolated node(s):** `concurrently`, `tailwindcss`, `@laravel/multiplex`
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 120 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **17 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `require-dev` connect `require-dev` to `composer.json`?**
  _High betweenness centrality (0.017) - this node is a cross-community bridge._
- **What connects `concurrently`, `tailwindcss`, `@laravel/multiplex` to the rest of the system?**
  _3 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.08333333333333333 - nodes in this community are weakly interconnected._
- **Why does `scripts` connect `scripts` to `composer.json`?**
  _High betweenness centrality (0.017) - this node is a cross-community bridge._
- **Should `package.json` be split into smaller, more focused modules?**
  _Cohesion score 0.09956709956709957 - nodes in this community are weakly interconnected._
- **Why does `config` connect `config` to `composer.json`?**
  _High betweenness centrality (0.013) - this node is a cross-community bridge._
- **Should `Laravel Boost Guidelines` be split into smaller, more focused modules?**
  _Cohesion score 0.1 - nodes in this community are weakly interconnected._