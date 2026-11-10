# Graph Report - growlytics  (2026-11-10)

## Corpus Check
- 314 files · ~1,661,341 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 5988 nodes · 14384 edges · 366 communities (315 shown, 51 thin omitted)
- Extraction: 90% EXTRACTED · 10% INFERRED · 0% AMBIGUOUS · INFERRED: 1510 edges (avg confidence: 0.85)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `10b82e44`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Illuminate\Database\Migrations\Migration
- composer.json
- ms
- devDependencies
- n
- StreamGrowtopiaListings.php
- ItemPriceHistoryService
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
- Controller
- chart.umd.js
- item-detail.js
- tn
- index.global.min.js
- a
- p
- swiper-bundle.min.js
- moment.min.js
- apexcharts.min.js
- ei
- c
- Hn
- pi
- U
- t
- Qe
- .constructor
- moment.js
- q
- bt
- a
- bootstrap.bundle.min.js
- El
- E
- a
- gridjs.umd.js
- he
- i
- User
- vt
- .bbox
- .init
- xt
- .add
- E
- us
- t
- O
- oi
- n
- .getContext
- fo
- sweetalert2.min.js
- Qn
- Sortable.min.js
- pa
- l
- ho
- qn
- xt
- zt
- dom-autoscroller.min.js
- wi
- leaflet.js
- localeData
- getParsingFlags
- remove
- isValid
- c
- dragula.min.js
- createDuration
- Item
- glightbox.min.js
- ta
- Lt
- _l
- ds
- Iw
- quill.min.js
- yt
- MaterialDesign-Webfont-7.4.47/package.json
- lc
- apps/js/app.js
- sn
- HomeController
- ug
- constructor
- s
- n
- Gs
- TopItemsThisWeekTest
- dn
- Illuminate\Support\Str
- Ba
- simplebar.min.js
- initiateExpression
- ts
- ca
- ItemSlugGenerator
- configFromArray
- index.js
- o
- Ki
- mailbox.init.js
- m
- todo.init.js
- shepherd.min.js
- LoginRequest
- $bm_isInstanceOfArray
- ks
- F
- scripts
- tasks-list.init.js
- .getDatasetMeta
- kr
- Illuminate\Http\Request
- z
- calendar.init.js
- file-manager.init.js
- landing.init.js
- ticketlist.init.js
- Ut
- dropzone-min.js
- filepond.min.js
- getLocale
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
- W
- chat.init.js
- ecommerce-customer-list.init.js
- ecommerce-order.init.js
- i
- team.init.js
- kt
- isFunction
- as
- Jt
- DashboardController
- createUTC
- .newLine
- crm-contact.init.js
- job-application.init.js
- listjs.init.js
- card.js
- hs
- ls
- m
- st
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
- de
- helpers.php
- crm-companies.init.js
- job-candidate-grid.init.js
- job-candidate-lists.init.js
- job-grid-list.init.js
- NewPasswordController.php
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
- .defs
- guest/layouts/master.blade.php
- dashboard-ecommerce.init.js
- dashboard-job.init.js
- dashboard-nft.init.js
- ecommerce-cart.init.js
- two-step-verification.init.js
- i
- layouts.navigation
- ListingIngestService
- kc
- Illuminate\View\View
- DatabaseSeeder
- rn
- rn
- as
- ProfileController.php
- S
- .constructor
- .constructor
- RoleMiddleware.php
- autoload-dev
- dev
- test

## God Nodes (most connected - your core abstractions)
1. `E()` - 135 edges
2. `tn` - 124 edges
3. `p()` - 83 edges
4. `i()` - 82 edges
5. `a()` - 76 edges
6. `Item` - 75 edges
7. `o()` - 71 edges
8. `r()` - 70 edges
9. `c()` - 68 edges
10. `e()` - 68 edges

## Surprising Connections (you probably didn't know these)
- `o()` --indirect_call--> `E()`  [INFERRED]
  public/apps/js/pages/plugins/lord-icon-2.1.0.js → public/apps/js/app.js
- `T()` --indirect_call--> `x()`  [INFERRED]
  public/apps/js/app.js → public/apps/js/pages/plugins/lord-icon-2.1.0.js
- `gt()` --indirect_call--> `Et()`  [INFERRED]
  public/apps/libs/gridjs/gridjs.umd.js → public/apps/libs/apexcharts/apexcharts.min.js
- `si()` --indirect_call--> `Yt()`  [INFERRED]
  public/apps/libs/bootstrap/js/bootstrap.bundle.min.js → public/apps/libs/moment/min/moment.min.js
- `ze()` --indirect_call--> `Ye()`  [INFERRED]
  public/apps/libs/fullcalendar/index.global.min.js → public/apps/libs/chart.js/chart.umd.js

## Import Cycles
- None detected.

## Communities (366 total, 51 thin omitted)

### Community 0 - "Illuminate\Database\Migrations\Migration"
Cohesion: 0.11
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

### Community 1 - "composer.json"
Cohesion: 0.14
Nodes (13): description, extra, laravel, keywords, dont-discover, license, minimum-stability, name (+5 more)

### Community 2 - "ms"
Cohesion: 0.15
Nodes (5): gr(), ms(), sc, wl, z()

### Community 3 - "devDependencies"
Cohesion: 0.06
Nodes (31): alpinejs, autoprefixer, concurrently, echarts, @laravel/multiplex, laravel-vite-plugin, dependencies, echarts (+23 more)

### Community 4 - "n"
Cohesion: 0.05
Nodes (52): Al(), n(), cA(), cv(), dv(), ea(), fv(), go() (+44 more)

### Community 5 - "StreamGrowtopiaListings.php"
Cohesion: 0.08
Nodes (16): BackfillItemSlugs, StreamGrowtopiaListings, SseEvent, SseParser, Closure, GuzzleHttp\Exception\GuzzleException, Illuminate\Console\Attributes\Description, Illuminate\Console\Attributes\Signature (+8 more)

### Community 6 - "ItemPriceHistoryService"
Cohesion: 0.13
Nodes (8): ItemPriceHistoryService, Carbon, ItemRecentWorldListingsService, ItemSearchService, TopItemsThisWeekService, Carbon\Carbon, Illuminate\Support\Collection, Illuminate\Support\Facades\Cache

### Community 7 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 9 - "Listing"
Cohesion: 0.10
Nodes (5): Listing, Illuminate\Support\Facades\Http, GrowlyticsStreamCommandTest, ItemRecentWorldsTest, ListingIngestServiceTest

### Community 10 - "AGENTS.md"
Cohesion: 0.14
Nodes (12): Admin and Guest Separation, Agent Workflow, Analytics Rules, Backend Conventions, Database Rules, Deployment Safety, Frontend Rules — CRITICAL, graphify (+4 more)

### Community 11 - "Growlytics"
Cohesion: 0.09
Nodes (22): Commands, Database, Debugging, Deployment, Development Guidelines, Environment Configuration, Features, Frontend Architecture (+14 more)

### Community 12 - "echarts.min.js"
Cohesion: 0.02
Nodes (137): Ab(), aR(), at(), au(), Ax(), B(), bB(), be() (+129 more)

### Community 13 - "logging.php"
Cohesion: 0.40
Nodes (4): Monolog\Handler\NullHandler, Monolog\Handler\StreamHandler, Monolog\Handler\SyslogUdpHandler, Monolog\Processor\PsrLogMessageProcessor

### Community 14 - "lord-icon-2.1.0.js"
Cohesion: 0.02
Nodes (60): addBrightnessToRGB(), addDecorator(), addHueToRGB(), addSaturationToRGB(), boxIntersect(), checkReady(), createNS(), createProxyFunction() (+52 more)

### Community 16 - "SseParserTest"
Cohesion: 0.10
Nodes (3): PHPUnit\Framework\TestCase, ExampleTest, SseParserTest

### Community 18 - "Controller"
Cohesion: 0.14
Nodes (10): ConfirmablePasswordController, EmailVerificationNotificationController, EmailVerificationPromptController, PasswordController, PasswordResetLinkController, RegisteredUserController, VerifyEmailController, Controller (+2 more)

### Community 19 - "chart.umd.js"
Cohesion: 0.03
Nodes (68): ai(), at(), average(), b(), beforeDatasetDraw(), beforeDatasetsDraw(), beforeDraw(), beforeLayout() (+60 more)

### Community 25 - "item-detail.js"
Cohesion: 0.13
Nodes (26): close(), initializeGuestPage(), onInput(), onKeyDown(), performSearch(), scrollActive(), bootstrapItemDetail(), chartEl (+18 more)

### Community 27 - "tn"
Cohesion: 0.04
Nodes (9): addBox(), d(), Ie(), ke(), Pn(), start(), tn, u() (+1 more)

### Community 28 - "index.global.min.js"
Cohesion: 0.02
Nodes (77): Mr(), ai(), be(), bo, Br(), Bs(), Cn(), co (+69 more)

### Community 29 - "a"
Cohesion: 0.08
Nodes (92): aA(), c(), p(), An(), ba(), r(), u(), bl() (+84 more)

### Community 30 - "p"
Cohesion: 0.04
Nodes (65): Ao(), at(), b(), Bn, ci(), cl(), componentWillUnmount(), di() (+57 more)

### Community 31 - "swiper-bundle.min.js"
Cohesion: 0.09
Nodes (55): a(), addEventListener(), b(), blur(), c(), C(), cancelAnimationFrame(), ce() (+47 more)

### Community 32 - "moment.min.js"
Cohesion: 0.06
Nodes (72): tn(), a(), Ae(), an(), at(), b(), be(), bt() (+64 more)

### Community 33 - "apexcharts.min.js"
Cohesion: 0.03
Nodes (50): active(), _addRunner(), amove(), array(), attr(), ax(), ay(), cancelImmediate() (+42 more)

### Community 34 - "ei"
Cohesion: 0.07
Nodes (6): ei, er, ft(), gt(), hr(), parse()

### Community 35 - "c"
Cohesion: 0.05
Nodes (10): s(), t(), b(), c(), createTag(), substr(), s(), n() (+2 more)

### Community 36 - "Hn"
Cohesion: 0.08
Nodes (15): an(), bc(), ct(), da(), en, getMarkerDay(), getMarkerMonth(), getMarkerYear() (+7 more)

### Community 37 - "pi"
Cohesion: 0.07
Nodes (8): aa(), batchRendering(), events(), ni(), oa, pi(), wn(), za

### Community 38 - "U"
Cohesion: 0.11
Nodes (31): A(), Ad(), ay(), bk(), bv(), ed(), fD(), hy() (+23 more)

### Community 39 - "t"
Cohesion: 0.08
Nodes (66): a(), b(), bt(), ct(), d(), dt(), e(), f() (+58 more)

### Community 40 - "Qe"
Cohesion: 0.08
Nodes (14): animate(), cancelFrame(), frame(), je, plot(), Qe, _queueNumberDelta(), _queueObject() (+6 more)

### Community 41 - ".constructor"
Cohesion: 0.04
Nodes (16): Ta(), A(), ar(), Bi(), destroy(), ja, ji(), ka() (+8 more)

### Community 42 - "moment.js"
Cohesion: 0.04
Nodes (38): RFC-2822, add$1(), addSubtract$1(), addTimeToArrayFromToken(), extractFromRFC2822Strings(), get$1(), getParseRegexForToken(), hasOwnProp() (+30 more)

### Community 43 - "q"
Cohesion: 0.08
Nodes (27): Am(), ao(), cb(), db(), eb(), ef(), ib(), g() (+19 more)

### Community 44 - "bt"
Cohesion: 0.05
Nodes (23): b(), bi, bt, clipWith(), componentTransfer(), fontface(), J(), linker() (+15 more)

### Community 45 - "a"
Cohesion: 0.07
Nodes (20): a(), aa(), Ae(), afterUpdate(), configure(), determineDataLimits(), Di(), g() (+12 more)

### Community 46 - "bootstrap.bundle.min.js"
Cohesion: 0.08
Nodes (52): be(), Ce(), D(), De(), _e(), ei(), Fe(), fi() (+44 more)

### Community 47 - "El"
Cohesion: 0.06
Nodes (9): El, is, ml(), mt(), ol(), pl(), Sl, ss() (+1 more)

### Community 48 - "E"
Cohesion: 0.05
Nodes (69): aw(), az(), bf(), c(), Cm(), ct(), df(), Dk() (+61 more)

### Community 49 - "a"
Cohesion: 0.06
Nodes (27): a(), addPropertyDecorator(), e(), i(), l(), r(), d(), e() (+19 more)

### Community 50 - "gridjs.umd.js"
Cohesion: 0.15
Nodes (50): a(), At(), b(), bt(), C(), Cn(), Ct(), dn() (+42 more)

### Community 51 - "he"
Cohesion: 0.07
Nodes (6): ai, ce, he, ke, mergeWith(), toConsumable()

### Community 52 - "i"
Cohesion: 0.06
Nodes (47): bG(), br(), cc(), e(), ce(), Ci(), da(), dc() (+39 more)

### Community 53 - "User"
Cohesion: 0.07
Nodes (18): User, Illuminate\Auth\Events\Verified, Illuminate\Auth\Notifications\ResetPassword, Illuminate\Foundation\Auth\User, Illuminate\Foundation\Testing\RefreshDatabase, Illuminate\Foundation\Testing\TestCase, Illuminate\Support\Facades\Event, Illuminate\Support\Facades\Notification (+10 more)

### Community 54 - "vt"
Cohesion: 0.08
Nodes (3): ls, mt(), vt

### Community 55 - ".bbox"
Cohesion: 0.06
Nodes (14): cy(), dx(), dy(), ee(), ge, hi, ie(), Ja (+6 more)

### Community 56 - ".init"
Cohesion: 0.07
Nodes (18): as(), center(), createPointHandles(), createResizeHandles(), createRotationHandle(), draggable(), Fe, init() (+10 more)

### Community 57 - "xt"
Cohesion: 0.06
Nodes (13): Dt, ft(), getEventHolder(), gt(), It(), ki, Pe(), Rt (+5 more)

### Community 58 - ".add"
Cohesion: 0.07
Nodes (21): ac(), ea(), expand(), fr, Ko(), lr(), mr(), na() (+13 more)

### Community 59 - "E"
Cohesion: 0.10
Nodes (14): a(), b(), c(), E, g(), k(), l(), n() (+6 more)

### Community 61 - "t"
Cohesion: 0.10
Nodes (24): a(), At(), c(), constructor(), Ct, d(), _draw(), e() (+16 more)

### Community 62 - "O"
Cohesion: 0.10
Nodes (18): Bc(), Da(), F(), fc(), gc(), hc(), ic(), jc() (+10 more)

### Community 63 - "oi"
Cohesion: 0.07
Nodes (10): et(), fa(), Ke(), Me, oi(), R(), tt(), ua (+2 more)

### Community 64 - "n"
Cohesion: 0.05
Nodes (23): Be(), e(), ei(), en, fn(), gi(), gn(), je() (+15 more)

### Community 65 - ".getContext"
Cohesion: 0.10
Nodes (12): ao(), Bi(), Ci(), co(), cs, Do(), Fi(), inXRange() (+4 more)

### Community 67 - "sweetalert2.min.js"
Cohesion: 0.09
Nodes (18): dt(), e(), emit(), En, Ft(), _getHandlersByEventName(), _main(), mt() (+10 more)

### Community 68 - "Qn"
Cohesion: 0.11
Nodes (5): fl, Ie(), Qn(), ro, ws

### Community 69 - "Sortable.min.js"
Cohesion: 0.13
Nodes (25): a(), b(), Bt(), D(), e(), f(), g(), h() (+17 more)

### Community 70 - "pa"
Cohesion: 0.13
Nodes (3): ba(), Ge(), pa()

### Community 71 - "l"
Cohesion: 0.07
Nodes (28): Bn(), buildTicks(), _calculateBarIndexPixels(), _calculateBarValuePixels(), getLabelAndValue(), getLabelForValue(), getPixelForTick(), getPixelForValue() (+20 more)

### Community 72 - "ho"
Cohesion: 0.07
Nodes (14): buildLookupTable(), _generate(), getDecimalForValue(), _getTimestampsForTable(), getValueForPixel(), ho(), initOffsets(), io() (+6 more)

### Community 73 - "qn"
Cohesion: 0.14
Nodes (16): BD(), Fn(), Gd(), Hd(), Hn(), ii(), it(), jn() (+8 more)

### Community 74 - "xt"
Cohesion: 0.10
Nodes (6): an(), as(), on, rs(), ts(), xt

### Community 75 - "zt"
Cohesion: 0.09
Nodes (15): Et(), Bt(), color(), Ft(), Gt(), It(), jt(), kt() (+7 more)

### Community 76 - "dom-autoscroller.min.js"
Cohesion: 0.13
Nodes (29): a(), c(), d(), e(), f(), h(), i(), n() (+21 more)

### Community 78 - "leaflet.js"
Cohesion: 0.07
Nodes (7): a(), Ci(), ei(), ii(), l(), ri(), x()

### Community 79 - "localeData"
Cohesion: 0.09
Nodes (30): addFormatToken(), addWeekYearFormatToken(), expandFormat(), replaceLongDateFormatTokens(), format(), formatMoment(), from(), fromNow() (+22 more)

### Community 80 - "getParsingFlags"
Cohesion: 0.10
Nodes (33): calculateOffset(), checkOverflow(), checkWeekday(), configFromInput(), configFromISO(), configFromRFC2822(), configFromString(), configFromStringAndArray() (+25 more)

### Community 81 - "remove"
Cohesion: 0.13
Nodes (4): kn, Q, remove(), Tn()

### Community 82 - "isValid"
Cohesion: 0.12
Nodes (37): clone(), cloneWithOffset(), createLocal(), createUnix(), diff(), endOf(), get$2(), getCalendarFormat() (+29 more)

### Community 83 - "c"
Cohesion: 0.20
Nodes (23): ac(), Ca(), cc(), d(), e(), f(), g(), h() (+15 more)

### Community 84 - "dragula.min.js"
Cohesion: 0.21
Nodes (27): a(), b(), c(), D(), E(), ee(), F(), n() (+19 more)

### Community 85 - "createDuration"
Cohesion: 0.10
Nodes (26): absRound(), addParseToken(), addSubtract(), addWeekParseToken(), clone$1(), createDuration(), createInvalid$1(), daysInMonth() (+18 more)

### Community 86 - "Item"
Cohesion: 0.10
Nodes (5): Item, static, ItemDetailTest, ItemPriceHistoryTest, ItemSearchTest

### Community 87 - "glightbox.min.js"
Cohesion: 0.23
Nodes (23): a(), b(), c(), d(), e(), f(), g(), h() (+15 more)

### Community 88 - "ta"
Cohesion: 0.12
Nodes (6): Ga(), sa(), ta(), Wa(), X(), Xa()

### Community 90 - "_l"
Cohesion: 0.17
Nodes (22): ap(), cp(), dp(), Dy(), ep(), fp(), hp(), I() (+14 more)

### Community 91 - "ds"
Cohesion: 0.12
Nodes (8): bl, ds, fs(), gs(), kn(), ps(), us(), zl

### Community 92 - "Iw"
Cohesion: 0.19
Nodes (15): bi(), Cw(), di(), Dw(), Ew(), fi(), hi(), hw() (+7 more)

### Community 93 - "quill.min.js"
Cohesion: 0.44
Nodes (23): a(), b(), c(), d(), e(), f(), f(), g() (+15 more)

### Community 94 - "yt"
Cohesion: 0.10
Nodes (9): bt(), cc(), ic(), jl, nc, pt(), rc, xl (+1 more)

### Community 95 - "MaterialDesign-Webfont-7.4.47/package.json"
Cohesion: 0.08
Nodes (23): author, name, web, bugs, url, description, homepage, keywords (+15 more)

### Community 97 - "apps/js/app.js"
Cohesion: 0.17
Nodes (16): b(), c(), D(), s(), E(), G(), i(), l() (+8 more)

### Community 100 - "ug"
Cohesion: 0.21
Nodes (14): ag(), cg(), dg(), eg(), hg(), lg(), mp(), i() (+6 more)

### Community 101 - "constructor"
Cohesion: 0.07
Nodes (18): al, componentDidMount(), componentDidUpdate(), constructor(), cs, dc(), eo(), flushScrollReset() (+10 more)

### Community 102 - "s"
Cohesion: 0.06
Nodes (37): bo, bs(), ct(), eo(), es(), et(), f(), ge() (+29 more)

### Community 103 - "n"
Cohesion: 0.32
Nodes (19): a(), e(), i(), n(), c(), d(), f(), i() (+11 more)

### Community 104 - "Gs"
Cohesion: 0.23
Nodes (3): getElementFromSelector(), Gs, qs()

### Community 106 - "dn"
Cohesion: 0.18
Nodes (4): dn, ln(), ha, mn()

### Community 107 - "Illuminate\Support\Str"
Cohesion: 0.09
Nodes (14): ItemFactory, ListingFactory, static, UserFactory, Illuminate\Database\Eloquent\Attributes\Fillable, Illuminate\Database\Eloquent\Attributes\Hidden, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Database\Eloquent\Factories\HasFactory (+6 more)

### Community 108 - "Ba"
Cohesion: 0.17
Nodes (6): afterDraw(), afterEvent(), Ba, Va(), wi(), za()

### Community 109 - "simplebar.min.js"
Cohesion: 0.21
Nodes (11): a(), e(), i(), S(), b(), f(), g(), m() (+3 more)

### Community 110 - "initiateExpression"
Cohesion: 0.14
Nodes (8): initialize$2(), initiateExpression(), applyEase(), ease(), easeIn(), easeOut(), executeExpression(), seedRandom()

### Community 114 - "configFromArray"
Cohesion: 0.17
Nodes (18): configFromArray(), createUTCDate(), currentDateArray(), dayOfYearFromWeekInfo(), dayOfYearFromWeeks(), daysInYear(), defaults(), firstWeekOffset() (+10 more)

### Community 115 - "index.js"
Cohesion: 0.19
Nodes (10): dispose(), handleCancel(), handleEnd(), handleMove(), handleStart(), onMouseMove(), onMove(), onStarClick() (+2 more)

### Community 116 - "o"
Cohesion: 0.15
Nodes (11): bezFunction(), o(), g(), substring(), o(), p(), random(), seedRandom() (+3 more)

### Community 118 - "mailbox.init.js"
Cohesion: 0.23
Nodes (12): checkBoxAll(), a(), emailDetailChange(), emailDetailShow(), favouriteBtn(), loader, loadMailData(), loadPromotionsMailData() (+4 more)

### Community 120 - "todo.init.js"
Cohesion: 0.25
Nodes (14): checkTaskStatus(), drawList(), editTodoList(), fetchIdFromObj(), findNextId(), isPriority(), isStatus(), load() (+6 more)

### Community 121 - "shepherd.min.js"
Cohesion: 0.14
Nodes (34): $a(), ab(), Bb(), Cb(), D(), db(), E(), Eb() (+26 more)

### Community 122 - "LoginRequest"
Cohesion: 0.15
Nodes (8): AuthenticatedSessionController, LoginRequest, Illuminate\Auth\Events\Lockout, Illuminate\Contracts\Validation\ValidationRule, Illuminate\Foundation\Http\FormRequest, Illuminate\Support\Facades\Auth, Illuminate\Support\Facades\RateLimiter, Illuminate\Validation\Rule

### Community 123 - "$bm_isInstanceOfArray"
Cohesion: 0.21
Nodes (15): $bm_isInstanceOfArray(), $bm_neg(), div(), getPerpendicularVector(), getProjectingAngle(), isNumerable(), length(), mul() (+7 more)

### Community 125 - "F"
Cohesion: 0.18
Nodes (15): F(), G(), h(), j(), k(), ke(), me(), ne() (+7 more)

### Community 126 - "scripts"
Cohesion: 0.13
Nodes (16): scripts, post-autoload-dump, post-root-package-install, post-update-cmd, pre-package-uninstall, setup, composer install, Illuminate\\Foundation\\ComposerScripts::postAutoloadDump (+8 more)

### Community 128 - ".getDatasetMeta"
Cohesion: 0.16
Nodes (7): afterDatasetsUpdate(), da(), generateLabels(), getBasePixel(), labelColor(), labelPointStyle(), onClick()

### Community 130 - "Illuminate\Http\Request"
Cohesion: 0.25
Nodes (6): ItemController, Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware, Illuminate\Http\JsonResponse, Illuminate\Http\Request

### Community 131 - "z"
Cohesion: 0.08
Nodes (40): ac(), Cr(), D(), Dr(), ec(), eM(), ez(), Fm() (+32 more)

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

### Community 140 - "getLocale"
Cohesion: 0.21
Nodes (14): chooseLocale(), compareArrays(), createAdder(), defineLocale(), deprecate(), deprecateSimple(), getLocale(), getSetGlobalLocale() (+6 more)

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

### Community 154 - "chat.init.js"
Cohesion: 0.31
Nodes (6): e(), p(), t(), u(), v(), w()

### Community 158 - "team.init.js"
Cohesion: 0.36
Nodes (8): bookmarkBtn(), editMemberList(), fetchIdFromObj(), findNextId(), loadTeamData(), memberDetailShow(), removeItem(), sortElementsById()

### Community 160 - "isFunction"
Cohesion: 0.13
Nodes (16): addRegexToken(), calendar(), calendar$1(), configFromObject(), Duration(), getPrioritizedUnits(), isDurationValid(), isFunction() (+8 more)

### Community 162 - "Jt"
Cohesion: 0.20
Nodes (10): Ae(), Ie(), Jt(), Le(), O(), Qt(), Re(), $t() (+2 more)

### Community 164 - "createUTC"
Cohesion: 0.24
Nodes (9): computeMonthsParse(), computeWeekdaysParse(), cmpLenRev(), createUTC(), handleStrictParse(), handleStrictParse$1(), localeMonthsParse(), localeWeekdaysParse() (+1 more)

### Community 165 - ".newLine"
Cohesion: 0.22
Nodes (3): dmove(), li, oi

### Community 169 - "card.js"
Cohesion: 0.31
Nodes (4): b(), c(), d(), p()

### Community 172 - "m"
Cohesion: 0.31
Nodes (9): at(), be(), d(), m(), ve(), W(), xe(), ye() (+1 more)

### Community 174 - "api-key.init.js"
Cohesion: 0.29
Nodes (3): generateApiID(), refreshCallbacks(), xhttp

### Community 175 - "filepond-plugin-image-preview.min.js"
Cohesion: 0.46
Nodes (6): a(), i(), r(), t(), a(), n()

### Community 176 - "e"
Cohesion: 0.25
Nodes (8): bi(), c(), e(), hi(), Pi(), Qe(), Ti(), u()

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

### Community 185 - "de"
Cohesion: 0.23
Nodes (4): ce(), de, dt(), he()

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

### Community 193 - "NewPasswordController.php"
Cohesion: 0.21
Nodes (7): Illuminate\Auth\Events\PasswordReset, Illuminate\Auth\Events\Registered, Illuminate\Support\Facades\Hash, Illuminate\Support\Facades\Password, Illuminate\Validation\Rules, Illuminate\Validation\Rules\Password, Illuminate\Validation\ValidationException

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

### Community 211 - ".defs"
Cohesion: 0.27
Nodes (5): defs(), gradient(), marker(), pattern(), si

### Community 228 - "i"
Cohesion: 1.00
Nodes (3): i(), Mi(), zi()

### Community 350 - "ListingIngestService"
Cohesion: 0.24
Nodes (3): ListingIngestService, Carbon, Illuminate\Support\Carbon

### Community 351 - "kc"
Cohesion: 0.17
Nodes (6): B(), kc(), Qb(), Rb(), Sb(), Ub()

### Community 352 - "Illuminate\View\View"
Cohesion: 0.27
Nodes (5): NewPasswordController, AppLayout, GuestLayout, Illuminate\View\Component, Illuminate\View\View

### Community 353 - "DatabaseSeeder"
Cohesion: 0.27
Nodes (5): DatabaseSeeder, UsersTableSeeder, Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Seeder, Illuminate\Support\Facades\DB

### Community 355 - "rn"
Cohesion: 0.28
Nodes (3): on, rn(), sn

### Community 356 - "as"
Cohesion: 0.25
Nodes (9): absCeil(), absFloor(), as(), bubble(), daysToMonths(), makeAs(), monthsToDays(), relativeTime$1() (+1 more)

### Community 357 - "ProfileController.php"
Cohesion: 0.29
Nodes (3): ProfileController, ProfileUpdateRequest, Illuminate\Support\Facades\Redirect

### Community 358 - "S"
Cohesion: 0.29
Nodes (4): Na(), Oa(), S, V()

### Community 360 - ".constructor"
Cohesion: 0.40
Nodes (4): nc(), oc(), rc, tb()

### Community 361 - ".constructor"
Cohesion: 0.40
Nodes (4): uc(), vb(), vc(), xc

### Community 363 - "autoload-dev"
Cohesion: 0.67
Nodes (3): autoload-dev, psr-4, Tests\\

### Community 364 - "dev"
Cohesion: 0.67
Nodes (3): dev, Composer\\Config::disableProcessTimeout, @php artisan dev

### Community 365 - "test"
Cohesion: 0.67
Nodes (3): test, @php artisan config:clear --ansi @no_additional_args, @php artisan test

## Knowledge Gaps
- **152 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+147 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **51 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Et()` connect `zt` to `Lt`, `apexcharts.min.js`, `gridjs.umd.js`?**
  _High betweenness centrality (0.074) - this node is a cross-community bridge._
- **Why does `Bt()` connect `zt` to `chart.umd.js`?**
  _High betweenness centrality (0.050) - this node is a cross-community bridge._
- **Why does `Oi()` connect `a` to `.constructor`, `chart.umd.js`, `Ki`, `.add`, `p`?**
  _High betweenness centrality (0.033) - this node is a cross-community bridge._
- **Are the 10 inferred relationships involving `E()` (e.g. with `r()` and `p()`) actually correct?**
  _`E()` has 10 INFERRED edges - model-reasoned connections that need verification._
- **Are the 7 inferred relationships involving `p()` (e.g. with `gi()` and `N()`) actually correct?**
  _`p()` has 7 INFERRED edges - model-reasoned connections that need verification._
- **Are the 66 inferred relationships involving `i()` (e.g. with `A()` and `aA()`) actually correct?**
  _`i()` has 66 INFERRED edges - model-reasoned connections that need verification._
- **Are the 68 inferred relationships involving `a()` (e.g. with `A()` and `ac()`) actually correct?**
  _`a()` has 68 INFERRED edges - model-reasoned connections that need verification._