# Graph Report - growlytics  (2026-11-10)

## Corpus Check
- 298 files · ~1,654,817 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 5837 nodes · 14027 edges · 354 communities (311 shown, 43 thin omitted)
- Extraction: 89% EXTRACTED · 11% INFERRED · 0% AMBIGUOUS · INFERRED: 1505 edges (avg confidence: 0.85)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `b0234a5e`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Illuminate\Database\Migrations\Migration
- composer.json
- Illuminate\Support\Str
- devDependencies
- bootstrap/app.php
- StreamGrowtopiaListings.php
- ListingIngestService
- config
- AppServiceProvider
- Listing
- AGENTS.md
- Growlytics
- echarts.min.js
- logging.php
- lord-icon-2.1.0.js
- console.php
- SseParserTest
- artisan
- Illuminate\Http\Request
- chart.umd.js
- tn
- index.global.min.js
- i
- p
- swiper-bundle.min.js
- moment.min.js
- apexcharts.min.js
- ei
- c
- i
- pi
- U
- t
- Qe
- .constructor
- moment.js
- e
- bt
- a
- bootstrap.bundle.min.js
- Sl
- T
- a
- gridjs.umd.js
- he
- E
- User
- vt
- attr
- .init
- xt
- .add
- E
- us
- t
- shepherd.min.js
- oi
- n
- .getContext
- remove
- sweetalert2.min.js
- Qn
- Sortable.min.js
- pa
- s
- ho
- z
- xt
- zt
- dom-autoscroller.min.js
- El
- leaflet.js
- localeData
- getParsingFlags
- kn
- isValid
- c
- dragula.min.js
- toInt
- Ba
- glightbox.min.js
- ta
- Lt
- _l
- hs
- Rt
- quill.min.js
- de
- MaterialDesign-Webfont-7.4.47/package.json
- lc
- apps/js/app.js
- sn
- HomeController
- ug
- jn
- yi
- n
- Gs
- TopItemsThisWeekTest
- dn
- D
- getLocale
- simplebar.min.js
- initiateExpression
- W
- ca
- ms
- configFromArray
- index.js
- o
- Ki
- mailbox.init.js
- m
- todo.init.js
- E
- LoginRequest
- $bm_isInstanceOfArray
- ks
- F
- scripts
- tasks-list.init.js
- createLocal
- DashboardController
- st
- bf
- calendar.init.js
- file-manager.init.js
- landing.init.js
- ticketlist.init.js
- Ut
- dropzone-min.js
- filepond.min.js
- wi
- isotope.pkgd.min.js
- jsvectormap.min.js
- masonry.pkgd.min.js
- prism.js
- autoComplete.min.js
- calendar-month-grid.init.js
- invoicecreate.init.js
- job-list.init.js
- sellers.init.js
- Ji
- waves.min.js
- require-dev
- .defs
- chat.init.js
- ecommerce-customer-list.init.js
- ecommerce-order.init.js
- i
- team.init.js
- kt
- oo
- as
- Jt
- .plot
- createUTC
- fn
- crm-contact.init.js
- job-application.init.js
- listjs.init.js
- card.js
- hs
- ls
- m
- setup
- api-key.init.js
- filepond-plugin-image-preview.min.js
- e
- verify.js
- wNumb.min.js
- psr-4
- crm-leads.init.js
- ecommerce-product-list.init.js
- job-companies-lists.init.js
- feather.min.js
- as
- helpers.php
- crm-companies.init.js
- job-candidate-grid.init.js
- job-candidate-lists.init.js
- job-grid-list.init.js
- kr
- ks
- master.blade.php
- apexcharts-column.init.js
- apps-nft-explore.init.js
- tasks-kanban.init.js
- require
- post-create-project-cmd
- edit.blade.php
- dashboard-analytics.init.js
- Je
- list.min.js
- list.pagination.min.js
- Webfont - Material Design Icons
- S
- guest/layouts/master.blade.php
- dashboard-ecommerce.init.js
- dashboard-job.init.js
- dashboard-nft.init.js
- ecommerce-cart.init.js
- two-step-verification.init.js
- i
- layouts.navigation
- DatabaseSeeder
- Illuminate\View\Component
- .renderFgSegs
- extra

## God Nodes (most connected - your core abstractions)
1. `E()` - 135 edges
2. `tn` - 124 edges
3. `p()` - 83 edges
4. `i()` - 82 edges
5. `a()` - 76 edges
6. `o()` - 71 edges
7. `r()` - 70 edges
8. `c()` - 68 edges
9. `e()` - 68 edges
10. `U()` - 66 edges

## Surprising Connections (you probably didn't know these)
- `o()` --indirect_call--> `E()`  [INFERRED]
  public/apps/js/pages/plugins/lord-icon-2.1.0.js → public/apps/js/app.js
- `T()` --indirect_call--> `x()`  [INFERRED]
  public/apps/js/app.js → public/apps/js/pages/plugins/lord-icon-2.1.0.js
- `Bt()` --indirect_call--> `Et()`  [INFERRED]
  public/apps/libs/chart.js/chart.umd.js → public/apps/libs/apexcharts/apexcharts.min.js
- `gt()` --indirect_call--> `Et()`  [INFERRED]
  public/apps/libs/gridjs/gridjs.umd.js → public/apps/libs/apexcharts/apexcharts.min.js
- `si()` --indirect_call--> `Yt()`  [INFERRED]
  public/apps/libs/bootstrap/js/bootstrap.bundle.min.js → public/apps/libs/moment/min/moment.min.js

## Import Cycles
- None detected.

## Communities (354 total, 43 thin omitted)

### Community 0 - "Illuminate\Database\Migrations\Migration"
Cohesion: 0.14
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

### Community 1 - "composer.json"
Cohesion: 0.14
Nodes (13): autoload-dev, psr-4, description, keywords, license, minimum-stability, name, prefer-stable (+5 more)

### Community 2 - "Illuminate\Support\Str"
Cohesion: 0.22
Nodes (4): UserFactory, Illuminate\Support\Str, Pdo\Mysql, static

### Community 3 - "devDependencies"
Cohesion: 0.07
Nodes (28): alpinejs, autoprefixer, concurrently, @laravel/multiplex, laravel-vite-plugin, devDependencies, alpinejs, autoprefixer (+20 more)

### Community 4 - "bootstrap/app.php"
Cohesion: 0.40
Nodes (3): Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

### Community 5 - "StreamGrowtopiaListings.php"
Cohesion: 0.08
Nodes (16): StreamGrowtopiaListings, RoleMiddleware, SseEvent, SseParser, Closure, GuzzleHttp\Exception\GuzzleException, Illuminate\Console\Attributes\Description, Illuminate\Console\Attributes\Signature (+8 more)

### Community 6 - "ListingIngestService"
Cohesion: 0.25
Nodes (3): ListingIngestService, Carbon, Illuminate\Support\Carbon

### Community 7 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 9 - "Listing"
Cohesion: 0.08
Nodes (16): Item, Listing, ItemFactory, ListingFactory, Illuminate\Database\Eloquent\Attributes\Fillable, Illuminate\Database\Eloquent\Attributes\Hidden, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Database\Eloquent\Factories\HasFactory (+8 more)

### Community 10 - "AGENTS.md"
Cohesion: 0.14
Nodes (12): Admin and Guest Separation, Agent Workflow, Analytics Rules, Backend Conventions, Database Rules, Deployment Safety, Frontend Rules — CRITICAL, graphify (+4 more)

### Community 11 - "Growlytics"
Cohesion: 0.09
Nodes (22): Commands, Database, Debugging, Deployment, Development Guidelines, Environment Configuration, Features, Frontend Architecture (+14 more)

### Community 12 - "echarts.min.js"
Cohesion: 0.02
Nodes (139): Ab(), at(), au(), bB(), be(), bh(), bn(), bo() (+131 more)

### Community 13 - "logging.php"
Cohesion: 0.40
Nodes (4): Monolog\Handler\NullHandler, Monolog\Handler\StreamHandler, Monolog\Handler\SyslogUdpHandler, Monolog\Processor\PsrLogMessageProcessor

### Community 14 - "lord-icon-2.1.0.js"
Cohesion: 0.02
Nodes (60): addBrightnessToRGB(), addDecorator(), addHueToRGB(), addSaturationToRGB(), boxIntersect(), checkReady(), createNS(), createProxyFunction() (+52 more)

### Community 16 - "SseParserTest"
Cohesion: 0.10
Nodes (3): PHPUnit\Framework\TestCase, ExampleTest, SseParserTest

### Community 18 - "Illuminate\Http\Request"
Cohesion: 0.09
Nodes (24): AuthenticatedSessionController, ConfirmablePasswordController, EmailVerificationNotificationController, EmailVerificationPromptController, NewPasswordController, PasswordController, PasswordResetLinkController, RegisteredUserController (+16 more)

### Community 19 - "chart.umd.js"
Cohesion: 0.03
Nodes (71): ai(), at(), average(), beforeDatasetDraw(), beforeDatasetsDraw(), beforeDraw(), beforeUpdate(), ca (+63 more)

### Community 27 - "tn"
Cohesion: 0.04
Nodes (18): addBox(), afterDatasetsUpdate(), configure(), d(), da(), getBasePixel(), Ie(), ke() (+10 more)

### Community 28 - "index.global.min.js"
Cohesion: 0.03
Nodes (73): ai(), Ao(), batchRendering(), be(), bo, Br(), componentWillUnmount(), cr() (+65 more)

### Community 29 - "i"
Cohesion: 0.08
Nodes (90): aA(), c(), p(), An(), B(), ba(), bG(), r() (+82 more)

### Community 30 - "p"
Cohesion: 0.05
Nodes (50): A(), b(), ci(), cl(), di(), E(), ec(), s() (+42 more)

### Community 31 - "swiper-bundle.min.js"
Cohesion: 0.09
Nodes (55): a(), addEventListener(), b(), blur(), c(), C(), cancelAnimationFrame(), ce() (+47 more)

### Community 32 - "moment.min.js"
Cohesion: 0.06
Nodes (72): tn(), a(), Ae(), an(), at(), b(), be(), bt() (+64 more)

### Community 33 - "apexcharts.min.js"
Cohesion: 0.04
Nodes (34): _addRunner(), amove(), ax(), ay(), bi, cancelImmediate(), _clearTransformRunnersBefore(), clipper() (+26 more)

### Community 34 - "ei"
Cohesion: 0.04
Nodes (18): ei, en, er, getMarkerDay(), getMarkerMonth(), getMarkerYear(), Hn, hr() (+10 more)

### Community 35 - "c"
Cohesion: 0.05
Nodes (10): s(), t(), b(), c(), createTag(), substr(), s(), n() (+2 more)

### Community 36 - "i"
Cohesion: 0.07
Nodes (30): bs(), cn(), ct(), dn(), e(), ei(), fe(), Fs() (+22 more)

### Community 37 - "pi"
Cohesion: 0.06
Nodes (15): aa(), cc(), constructor(), cs, ft(), ka(), ni(), oa (+7 more)

### Community 38 - "U"
Cohesion: 0.06
Nodes (49): A(), Ad(), ao(), aR(), ay(), BD(), bk(), bv() (+41 more)

### Community 39 - "t"
Cohesion: 0.08
Nodes (66): a(), b(), bt(), ct(), d(), dt(), e(), f() (+58 more)

### Community 40 - "Qe"
Cohesion: 0.07
Nodes (16): animate(), cancelFrame(), dx(), dy(), frame(), je, plot(), Qe (+8 more)

### Community 41 - ".constructor"
Cohesion: 0.06
Nodes (14): ar(), Bi(), destroy(), ja, ji(), ns(), os, Qa (+6 more)

### Community 42 - "moment.js"
Cohesion: 0.04
Nodes (36): RFC-2822, add$1(), addSubtract$1(), addTimeToArrayFromToken(), configFromObject(), Duration(), extractFromRFC2822Strings(), getParseRegexForToken() (+28 more)

### Community 43 - "e"
Cohesion: 0.07
Nodes (37): n(), br(), e(), ce(), da(), dd(), ea(), er() (+29 more)

### Community 44 - "bt"
Cohesion: 0.06
Nodes (16): b(), bt, clipWith(), J(), linker(), linkTo(), maskWith(), parents() (+8 more)

### Community 45 - "a"
Cohesion: 0.06
Nodes (19): a(), aa(), afterUpdate(), bo, determineDataLimits(), Di(), H(), ki() (+11 more)

### Community 46 - "bootstrap.bundle.min.js"
Cohesion: 0.10
Nodes (47): be(), Ce(), D(), De(), _e(), ei(), Fe(), fi() (+39 more)

### Community 47 - "Sl"
Cohesion: 0.06
Nodes (12): bt(), ct(), ic(), is, jl, mt(), nc, pt() (+4 more)

### Community 48 - "T"
Cohesion: 0.06
Nodes (49): Al(), aw(), bw(), c(), cA(), cb(), db(), eb() (+41 more)

### Community 49 - "a"
Cohesion: 0.06
Nodes (27): a(), addPropertyDecorator(), e(), i(), l(), r(), d(), e() (+19 more)

### Community 50 - "gridjs.umd.js"
Cohesion: 0.15
Nodes (50): a(), At(), b(), bt(), C(), Cn(), Ct(), dn() (+42 more)

### Community 51 - "he"
Cohesion: 0.04
Nodes (15): active(), ai, ce, ci, clearTimeout(), fi, he, ke (+7 more)

### Community 52 - "E"
Cohesion: 0.05
Nodes (52): Am(), az(), Cl(), Cm(), ct(), Dk(), E(), el() (+44 more)

### Community 53 - "User"
Cohesion: 0.07
Nodes (18): User, Illuminate\Auth\Events\Verified, Illuminate\Auth\Notifications\ResetPassword, Illuminate\Foundation\Auth\User, Illuminate\Foundation\Testing\RefreshDatabase, Illuminate\Foundation\Testing\TestCase, Illuminate\Support\Facades\Event, Illuminate\Support\Facades\Notification (+10 more)

### Community 54 - "vt"
Cohesion: 0.08
Nodes (3): ls, mt(), vt

### Community 55 - "attr"
Cohesion: 0.05
Nodes (27): array(), attr(), cx(), cy(), dmove(), ee(), ge, hi (+19 more)

### Community 56 - ".init"
Cohesion: 0.06
Nodes (16): as(), createPointHandles(), createResizeHandles(), createRotationHandle(), draggable(), Fe, init(), is() (+8 more)

### Community 57 - "xt"
Cohesion: 0.07
Nodes (12): ft(), getEventHolder(), gt(), It(), ki, Pe(), Rt, Tt() (+4 more)

### Community 58 - ".add"
Cohesion: 0.06
Nodes (21): ac(), ea(), expand(), fr, Ko(), lr(), mr(), na() (+13 more)

### Community 59 - "E"
Cohesion: 0.10
Nodes (14): a(), b(), c(), E, g(), k(), l(), n() (+6 more)

### Community 60 - "us"
Cohesion: 0.09
Nodes (4): on(), one(), S(), us

### Community 61 - "t"
Cohesion: 0.08
Nodes (25): a(), At(), c(), constructor(), Ct, d(), _draw(), Dt (+17 more)

### Community 62 - "shepherd.min.js"
Cohesion: 0.07
Nodes (36): Bb(), Bc(), Cb(), Da(), F(), fa(), fc(), gc() (+28 more)

### Community 63 - "oi"
Cohesion: 0.08
Nodes (9): et(), fa(), Ke(), Me, oi(), R(), tt(), We() (+1 more)

### Community 64 - "n"
Cohesion: 0.09
Nodes (7): Be(), gn(), n(), ne(), numeric(), xn(), Ye()

### Community 65 - ".getContext"
Cohesion: 0.10
Nodes (11): ao(), Bi(), Ci(), co(), cs, Do(), Fi(), inXRange() (+3 more)

### Community 66 - "remove"
Cohesion: 0.14
Nodes (3): Q, remove(), ts

### Community 67 - "sweetalert2.min.js"
Cohesion: 0.09
Nodes (18): dt(), e(), emit(), En, Ft(), _getHandlersByEventName(), _main(), mt() (+10 more)

### Community 68 - "Qn"
Cohesion: 0.07
Nodes (8): ba(), fl, Ge(), Ie(), Qn(), ro, ws, Ys()

### Community 69 - "Sortable.min.js"
Cohesion: 0.13
Nodes (25): a(), b(), Bt(), D(), e(), f(), g(), h() (+17 more)

### Community 71 - "s"
Cohesion: 0.07
Nodes (32): Ae(), Bn(), buildTicks(), _calculateBarIndexPixels(), _calculateBarValuePixels(), fn(), getLabelAndValue(), getLabelForValue() (+24 more)

### Community 72 - "ho"
Cohesion: 0.06
Nodes (15): beforeLayout(), buildLookupTable(), _generate(), getDecimalForValue(), _getTimestampsForTable(), getValueForPixel(), Go(), ho() (+7 more)

### Community 73 - "z"
Cohesion: 0.07
Nodes (55): ac(), bi(), Bs(), a(), cs(), Cw(), di(), Dw() (+47 more)

### Community 74 - "xt"
Cohesion: 0.09
Nodes (6): an(), as(), on, rs(), ts(), xt

### Community 75 - "zt"
Cohesion: 0.09
Nodes (14): Bt(), color(), Ft(), Gt(), It(), jt(), kt(), mt() (+6 more)

### Community 76 - "dom-autoscroller.min.js"
Cohesion: 0.13
Nodes (29): a(), c(), d(), e(), f(), h(), i(), n() (+21 more)

### Community 77 - "El"
Cohesion: 0.07
Nodes (15): an(), bc(), Cn(), co, da(), El, fn(), ga() (+7 more)

### Community 78 - "leaflet.js"
Cohesion: 0.07
Nodes (7): a(), Ci(), ei(), ii(), l(), ri(), x()

### Community 79 - "localeData"
Cohesion: 0.07
Nodes (36): addFormatToken(), addRegexToken(), addWeekYearFormatToken(), calendar(), calendar$1(), expandFormat(), replaceLongDateFormatTokens(), format() (+28 more)

### Community 80 - "getParsingFlags"
Cohesion: 0.11
Nodes (30): calculateOffset(), checkOverflow(), checkWeekday(), configFromInput(), configFromISO(), configFromRFC2822(), configFromString(), configFromStringAndArray() (+22 more)

### Community 81 - "kn"
Cohesion: 0.09
Nodes (5): fo, d(), kn, lo(), Tn()

### Community 82 - "isValid"
Cohesion: 0.12
Nodes (34): clone(), cloneWithOffset(), diff(), endOf(), get$2(), getCalendarFormat(), getSetDayOfYear(), inspect() (+26 more)

### Community 83 - "c"
Cohesion: 0.24
Nodes (20): Ca(), cc(), d(), e(), f(), g(), h(), l() (+12 more)

### Community 84 - "dragula.min.js"
Cohesion: 0.21
Nodes (27): a(), b(), c(), D(), E(), ee(), F(), n() (+19 more)

### Community 85 - "toInt"
Cohesion: 0.12
Nodes (20): absFloor(), absRound(), addSubtract(), daysInMonth(), get(), getDateOffset(), getDaysInMonth(), getSetMonth() (+12 more)

### Community 86 - "Ba"
Cohesion: 0.11
Nodes (17): afterDraw(), afterEvent(), b(), Ba, eo(), f(), g(), g() (+9 more)

### Community 87 - "glightbox.min.js"
Cohesion: 0.23
Nodes (23): a(), b(), c(), d(), e(), f(), g(), h() (+15 more)

### Community 88 - "ta"
Cohesion: 0.11
Nodes (6): B(), kc(), Qb(), Rb(), ta(), X()

### Community 90 - "_l"
Cohesion: 0.17
Nodes (22): ap(), cp(), dp(), Dy(), ep(), fp(), hp(), I() (+14 more)

### Community 91 - "hs"
Cohesion: 0.11
Nodes (9): bl, Bs(), ds, fs(), gs(), hs(), kn(), ps() (+1 more)

### Community 92 - "Rt"
Cohesion: 0.14
Nodes (4): getElementFromSelector(), getSelectorFromElement(), Rt, Y

### Community 93 - "quill.min.js"
Cohesion: 0.44
Nodes (23): a(), b(), c(), d(), e(), f(), f(), g() (+15 more)

### Community 94 - "de"
Cohesion: 0.15
Nodes (5): ce(), de, dt(), en, he()

### Community 95 - "MaterialDesign-Webfont-7.4.47/package.json"
Cohesion: 0.08
Nodes (23): author, name, web, bugs, url, description, homepage, keywords (+15 more)

### Community 96 - "lc"
Cohesion: 0.11
Nodes (6): Ga(), lc, sa(), Wa(), Xa(), zc()

### Community 97 - "apps/js/app.js"
Cohesion: 0.17
Nodes (16): b(), c(), D(), s(), E(), G(), i(), l() (+8 more)

### Community 99 - "HomeController"
Cohesion: 0.17
Nodes (4): HomeController, TopItemsThisWeekService, Illuminate\Support\Collection, Illuminate\Support\Facades\Cache

### Community 100 - "ug"
Cohesion: 0.18
Nodes (16): ag(), cc(), dg(), eg(), hg(), lg(), mp(), i() (+8 more)

### Community 101 - "jn"
Cohesion: 0.08
Nodes (14): al, Bn, componentDidMount(), componentDidUpdate(), fe(), flushScrollReset(), ia(), jn() (+6 more)

### Community 102 - "yi"
Cohesion: 0.13
Nodes (10): at(), eo(), Ht(), markerToArray(), nn(), on, Qe(), rn() (+2 more)

### Community 103 - "n"
Cohesion: 0.32
Nodes (19): a(), e(), i(), n(), c(), d(), f(), i() (+11 more)

### Community 105 - "TopItemsThisWeekTest"
Cohesion: 0.22
Nodes (3): Carbon\Carbon, Carbon, TopItemsThisWeekTest

### Community 107 - "D"
Cohesion: 0.13
Nodes (19): Ax(), D(), dc(), eM(), eo(), Fm(), ic(), iy() (+11 more)

### Community 108 - "getLocale"
Cohesion: 0.11
Nodes (25): addParseToken(), addWeekParseToken(), chooseLocale(), compareArrays(), createAdder(), defineLocale(), deprecate(), deprecateSimple() (+17 more)

### Community 109 - "simplebar.min.js"
Cohesion: 0.21
Nodes (11): a(), e(), i(), S(), b(), f(), g(), m() (+3 more)

### Community 110 - "initiateExpression"
Cohesion: 0.14
Nodes (8): initialize$2(), initiateExpression(), applyEase(), ease(), easeIn(), easeOut(), executeExpression(), seedRandom()

### Community 111 - "W"
Cohesion: 0.06
Nodes (4): focusableChildren(), H, rn, W

### Community 113 - "ms"
Cohesion: 0.15
Nodes (5): gr(), ms(), sc, wl, z()

### Community 114 - "configFromArray"
Cohesion: 0.17
Nodes (18): configFromArray(), createUTCDate(), currentDateArray(), dayOfYearFromWeekInfo(), dayOfYearFromWeeks(), daysInYear(), defaults(), firstWeekOffset() (+10 more)

### Community 115 - "index.js"
Cohesion: 0.19
Nodes (10): dispose(), handleCancel(), handleEnd(), handleMove(), handleStart(), onMouseMove(), onMove(), onStarClick() (+2 more)

### Community 116 - "o"
Cohesion: 0.15
Nodes (11): bezFunction(), o(), g(), substring(), o(), p(), random(), seedRandom() (+3 more)

### Community 117 - "Ki"
Cohesion: 0.13
Nodes (3): Ki, Ni(), Pi()

### Community 118 - "mailbox.init.js"
Cohesion: 0.23
Nodes (12): checkBoxAll(), a(), emailDetailChange(), emailDetailShow(), favouriteBtn(), loader, loadMailData(), loadPromotionsMailData() (+4 more)

### Community 120 - "todo.init.js"
Cohesion: 0.25
Nodes (14): checkTaskStatus(), drawList(), editTodoList(), fetchIdFromObj(), findNextId(), isPriority(), isStatus(), load() (+6 more)

### Community 121 - "E"
Cohesion: 0.30
Nodes (16): E(), Eb(), Fb(), G(), Hb(), ib(), J(), Ja() (+8 more)

### Community 122 - "LoginRequest"
Cohesion: 0.19
Nodes (7): LoginRequest, ProfileUpdateRequest, Illuminate\Auth\Events\Lockout, Illuminate\Contracts\Validation\ValidationRule, Illuminate\Foundation\Http\FormRequest, Illuminate\Support\Facades\RateLimiter, Illuminate\Validation\Rule

### Community 123 - "$bm_isInstanceOfArray"
Cohesion: 0.21
Nodes (15): $bm_isInstanceOfArray(), $bm_neg(), div(), getPerpendicularVector(), getProjectingAngle(), isNumerable(), length(), mul() (+7 more)

### Community 125 - "F"
Cohesion: 0.18
Nodes (15): F(), G(), h(), j(), k(), ke(), me(), ne() (+7 more)

### Community 126 - "scripts"
Cohesion: 0.14
Nodes (14): scripts, dev, post-autoload-dump, post-update-cmd, pre-package-uninstall, test, Composer\\Config::disableProcessTimeout, Illuminate\\Foundation\\ComposerScripts::postAutoloadDump (+6 more)

### Community 128 - "createLocal"
Cohesion: 0.17
Nodes (15): clone$1(), createDuration(), createInvalid$1(), createLocal(), createUnix(), from(), fromNow(), hasAlignedHourOffset() (+7 more)

### Community 131 - "bf"
Cohesion: 0.08
Nodes (35): bf(), Bx(), Cf(), df(), Ff(), gE(), gR(), Gx() (+27 more)

### Community 132 - "calendar.init.js"
Cohesion: 0.20
Nodes (3): getTime(), tConvert(), upcomingEvent()

### Community 133 - "file-manager.init.js"
Cohesion: 0.27
Nodes (8): editFileList(), favouriteBtn(), fetchIdFromObj(), fileDetailShow(), loadFileData(), removefileOverview(), removeSingleItem(), sortElementsById()

### Community 135 - "landing.init.js"
Cohesion: 0.17
Nodes (3): counter(), menuToggle, navLinks

### Community 138 - "dropzone-min.js"
Cohesion: 0.30
Nodes (9): a(), e(), i(), l(), n(), o(), r(), s() (+1 more)

### Community 139 - "filepond.min.js"
Cohesion: 0.20
Nodes (5): ae(), o(), r(), le(), ue()

### Community 141 - "isotope.pkgd.min.js"
Cohesion: 0.44
Nodes (10): a(), i(), h(), u(), n(), o(), r(), e() (+2 more)

### Community 142 - "jsvectormap.min.js"
Cohesion: 0.35
Nodes (11): a(), b(), e(), i(), k(), n(), r(), s() (+3 more)

### Community 143 - "masonry.pkgd.min.js"
Cohesion: 0.38
Nodes (10): a(), i(), h(), u(), n(), o(), r(), s() (+2 more)

### Community 144 - "prism.js"
Cohesion: 0.21
Nodes (4): addAfter(), matchGrammar(), matchPattern(), removeRange()

### Community 145 - "autoComplete.min.js"
Cohesion: 0.36
Nodes (10): e(), c(), i(), j(), c(), o(), r(), s() (+2 more)

### Community 146 - "calendar-month-grid.init.js"
Cohesion: 0.22
Nodes (3): getTime(), tConvert(), upcomingEvent()

### Community 147 - "invoicecreate.init.js"
Cohesion: 0.38
Nodes (9): amountKeyup(), isData(), new_link(), otherPayment(), recalculateCart(), remove(), removeItem(), resetRow() (+1 more)

### Community 148 - "job-list.init.js"
Cohesion: 0.31
Nodes (7): fetchIdFromObj(), findNextId(), jobDetailShow(), loadJobListData(), paginationEvents(), selectedPage(), sortElementsById()

### Community 149 - "sellers.init.js"
Cohesion: 0.35
Nodes (9): fetchIdFromObj(), findNextId(), getChartColorsArray(), loadCharts(), loadSellerList(), pageEvent(), paginationEvents(), selectedPage() (+1 more)

### Community 151 - "waves.min.js"
Cohesion: 0.35
Nodes (10): a(), c(), e(), i(), n(), o(), r(), s() (+2 more)

### Community 152 - "require-dev"
Cohesion: 0.18
Nodes (11): require-dev, fakerphp/faker, fruitcake/laravel-debugbar, laravel/boost, laravel/breeze, laravel/pail, laravel/pao, laravel/pint (+3 more)

### Community 153 - ".defs"
Cohesion: 0.27
Nodes (5): defs(), gradient(), marker(), pattern(), si

### Community 154 - "chat.init.js"
Cohesion: 0.31
Nodes (6): e(), p(), t(), u(), v(), w()

### Community 158 - "team.init.js"
Cohesion: 0.36
Nodes (8): bookmarkBtn(), editMemberList(), fetchIdFromObj(), findNextId(), loadTeamData(), memberDetailShow(), removeItem(), sortElementsById()

### Community 160 - "oo"
Cohesion: 0.21
Nodes (4): io(), no(), oo, zi()

### Community 162 - "Jt"
Cohesion: 0.20
Nodes (10): Ae(), Ie(), Jt(), Le(), O(), Qt(), Re(), $t() (+2 more)

### Community 163 - ".plot"
Cohesion: 0.27
Nodes (4): center(), mi, updateRotFn(), updateSelection()

### Community 164 - "createUTC"
Cohesion: 0.24
Nodes (9): computeMonthsParse(), computeWeekdaysParse(), cmpLenRev(), createUTC(), handleStrictParse(), handleStrictParse$1(), localeMonthsParse(), localeWeekdaysParse() (+1 more)

### Community 165 - "fn"
Cohesion: 0.29
Nodes (10): $a(), ab(), D(), db(), fn(), ha(), ia(), Y() (+2 more)

### Community 169 - "card.js"
Cohesion: 0.31
Nodes (4): b(), c(), d(), p()

### Community 172 - "m"
Cohesion: 0.31
Nodes (9): at(), be(), d(), m(), ve(), W(), xe(), ye() (+1 more)

### Community 173 - "setup"
Cohesion: 0.25
Nodes (8): post-root-package-install, setup, composer install, npm install --ignore-scripts, npm run build, @php artisan key:generate, @php artisan migrate --force, @php -r \"file_exists('.env') || copy('.env.example', '.env');\

### Community 174 - "api-key.init.js"
Cohesion: 0.29
Nodes (3): generateApiID(), refreshCallbacks(), xhttp

### Community 175 - "filepond-plugin-image-preview.min.js"
Cohesion: 0.46
Nodes (6): a(), i(), r(), t(), a(), n()

### Community 176 - "e"
Cohesion: 0.29
Nodes (7): bi(), c(), e(), hi(), Qe(), Ti(), u()

### Community 177 - "verify.js"
Cohesion: 0.25
Nodes (7): fs, packageJson, packageText, parts, previewText, scssVariablesText, vParts

### Community 178 - "wNumb.min.js"
Cohesion: 0.43
Nodes (6): f(), h(), n(), r(), w(), x()

### Community 179 - "psr-4"
Cohesion: 0.29
Nodes (7): autoload, files, psr-4, App\\, Database\\Factories\\, Database\\Seeders\\, app/Helpers/helpers.php

### Community 182 - "ecommerce-product-list.init.js"
Cohesion: 0.38
Nodes (3): checkRemoveItem(), removeItems(), removeSingleItem()

### Community 183 - "job-companies-lists.init.js"
Cohesion: 0.52
Nodes (5): filterData(), jobDetailShow(), loadCompaniesListData(), paginationEvents(), selectedPage()

### Community 185 - "as"
Cohesion: 0.33
Nodes (7): absCeil(), as(), bubble(), daysToMonths(), makeAs(), monthsToDays(), relativeTime$1()

### Community 187 - "helpers.php"
Cohesion: 0.40
Nodes (3): guest_asset(), versioned_asset(), App\Models\Setting

### Community 190 - "job-candidate-grid.init.js"
Cohesion: 0.60
Nodes (4): isStatus(), loadCandidateListData(), paginationEvents(), selectedPage()

### Community 191 - "job-candidate-lists.init.js"
Cohesion: 0.60
Nodes (4): isStatus(), loadCandidateListData(), paginationEvents(), selectedPage()

### Community 192 - "job-grid-list.init.js"
Cohesion: 0.60
Nodes (4): filterData(), loadJobListData(), paginationEvents(), selectedPage()

### Community 195 - "master.blade.php"
Cohesion: 0.40
Nodes (4): apps.layouts.partials.breadcrumb, apps.layouts.partials.footer, apps.layouts.partials.header, apps.layouts.partials.sidebar

### Community 197 - "apps-nft-explore.init.js"
Cohesion: 0.60
Nodes (3): loadMoreBtn(), loadProductData(), _toConsumableArray()

### Community 199 - "tasks-kanban.init.js"
Cohesion: 0.60
Nodes (3): newKanbanbaord(), noTaskImage(), taskCounter()

### Community 200 - "require"
Cohesion: 0.50
Nodes (4): require, laravel/framework, laravel/tinker, php

### Community 201 - "post-create-project-cmd"
Cohesion: 0.50
Nodes (4): post-create-project-cmd, @php artisan key:generate --ansi, @php artisan migrate --graceful --ansi, @php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\

### Community 202 - "edit.blade.php"
Cohesion: 0.50
Nodes (3): profile.partials.delete-user-form, profile.partials.update-password-form, profile.partials.update-profile-information-form

### Community 207 - "Je"
Cohesion: 0.67
Nodes (4): Je(), ni(), oi(), si()

### Community 209 - "list.pagination.min.js"
Cohesion: 0.83
Nodes (3): a(), c(), d()

### Community 210 - "Webfont - Material Design Icons"
Cohesion: 0.50
Nodes (3): Learn More, Related Packages, Webfont - Material Design Icons

### Community 211 - "S"
Cohesion: 0.22
Nodes (6): ac(), Na(), Oa(), S, V(), W()

### Community 228 - "i"
Cohesion: 1.00
Nodes (3): i(), Mi(), zi()

### Community 350 - "DatabaseSeeder"
Cohesion: 0.27
Nodes (5): DatabaseSeeder, UsersTableSeeder, Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Seeder, Illuminate\Support\Facades\DB

### Community 351 - "Illuminate\View\Component"
Cohesion: 0.38
Nodes (3): AppLayout, GuestLayout, Illuminate\View\Component

### Community 352 - ".renderFgSegs"
Cohesion: 0.33
Nodes (4): dl, ml(), ol(), pl()

### Community 353 - "extra"
Cohesion: 0.67
Nodes (3): extra, laravel, dont-discover

## Knowledge Gaps
- **147 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+142 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **43 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Et()` connect `Lt` to `apexcharts.min.js`, `gridjs.umd.js`, `zt`?**
  _High betweenness centrality (0.083) - this node is a cross-community bridge._
- **Why does `Bt()` connect `zt` to `Lt`, `chart.umd.js`?**
  _High betweenness centrality (0.058) - this node is a cross-community bridge._
- **Why does `Oi()` connect `a` to `Sl`, `chart.umd.js`, `Ki`, `.add`, `p`?**
  _High betweenness centrality (0.042) - this node is a cross-community bridge._
- **Are the 10 inferred relationships involving `E()` (e.g. with `r()` and `p()`) actually correct?**
  _`E()` has 10 INFERRED edges - model-reasoned connections that need verification._
- **Are the 7 inferred relationships involving `p()` (e.g. with `gi()` and `N()`) actually correct?**
  _`p()` has 7 INFERRED edges - model-reasoned connections that need verification._
- **Are the 66 inferred relationships involving `i()` (e.g. with `A()` and `aA()`) actually correct?**
  _`i()` has 66 INFERRED edges - model-reasoned connections that need verification._
- **Are the 68 inferred relationships involving `a()` (e.g. with `A()` and `ac()`) actually correct?**
  _`a()` has 68 INFERRED edges - model-reasoned connections that need verification._