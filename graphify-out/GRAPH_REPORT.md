# Graph Report - growlytics  (2026-11-10)

## Corpus Check
- 309 files · ~1,659,421 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 5931 nodes · 14261 edges · 359 communities (310 shown, 49 thin omitted)
- Extraction: 89% EXTRACTED · 11% INFERRED · 0% AMBIGUOUS · INFERRED: 1510 edges (avg confidence: 0.85)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `accada1c`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Illuminate\Database\Migrations\Migration
- composer.json
- s
- devDependencies
- bootstrap/app.php
- SseParser
- ItemPriceHistoryService
- config
- AppServiceProvider
- Item
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
- item-detail.js
- tn
- index.global.min.js
- i
- p
- swiper-bundle.min.js
- moment.min.js
- apexcharts.min.js
- ei
- c
- Hn
- pi
- Y
- t
- Qe
- .constructor
- moment.js
- e
- bt
- l
- bootstrap.bundle.min.js
- Sl
- q
- a
- gridjs.umd.js
- he
- E
- User
- vt
- .bbox
- .init
- xt
- .add
- E
- us
- t
- shepherd.min.js
- oi
- n
- ro
- .constructor
- sweetalert2.min.js
- .hide
- Sortable.min.js
- pa
- updateElements
- a
- U
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
- createDuration
- update
- glightbox.min.js
- ta
- Lt
- _l
- ms
- X
- quill.min.js
- render
- MaterialDesign-Webfont-7.4.47/package.json
- lc
- apps/js/app.js
- sn
- HomeController
- ug
- Qn
- rn
- n
- Gs
- TopItemsThisWeekTest
- dn
- Illuminate\Support\Str
- getLocale
- simplebar.min.js
- initiateExpression
- remove
- ca
- Wt
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
- isFunction
- StreamGrowtopiaListings
- st
- A
- calendar.init.js
- file-manager.init.js
- landing.init.js
- ticketlist.init.js
- ListingIngestService
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
- W
- chat.init.js
- ecommerce-customer-list.init.js
- ecommerce-order.init.js
- i
- team.init.js
- kt
- oo
- as
- Jt
- DashboardController
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
- fs
- StreamGrowtopiaListings.php
- extra
- rn
- HSVtoRGB
- Ut
- ki

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

## Communities (359 total, 49 thin omitted)

### Community 0 - "Illuminate\Database\Migrations\Migration"
Cohesion: 0.14
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

### Community 1 - "composer.json"
Cohesion: 0.14
Nodes (13): autoload-dev, psr-4, description, keywords, license, minimum-stability, name, prefer-stable (+5 more)

### Community 2 - "s"
Cohesion: 0.05
Nodes (29): Be(), bo, bs(), ce(), ct(), de, dt(), et() (+21 more)

### Community 3 - "devDependencies"
Cohesion: 0.06
Nodes (31): alpinejs, autoprefixer, concurrently, echarts, @laravel/multiplex, laravel-vite-plugin, dependencies, echarts (+23 more)

### Community 4 - "bootstrap/app.php"
Cohesion: 0.40
Nodes (3): Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

### Community 5 - "SseParser"
Cohesion: 0.20
Nodes (3): SseEvent, SseParser, Closure

### Community 6 - "ItemPriceHistoryService"
Cohesion: 0.35
Nodes (3): ItemPriceHistoryService, Carbon, Carbon\Carbon

### Community 7 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 9 - "Item"
Cohesion: 0.10
Nodes (8): Item, Listing, ItemRecentWorldListingsService, Illuminate\Support\Facades\DB, PHPUnit\Framework\Attributes\DataProvider, ItemPriceHistoryTest, ItemRecentWorldsTest, ListingIngestServiceTest

### Community 10 - "AGENTS.md"
Cohesion: 0.14
Nodes (12): Admin and Guest Separation, Agent Workflow, Analytics Rules, Backend Conventions, Database Rules, Deployment Safety, Frontend Rules — CRITICAL, graphify (+4 more)

### Community 11 - "Growlytics"
Cohesion: 0.09
Nodes (22): Commands, Database, Debugging, Deployment, Development Guidelines, Environment Configuration, Features, Frontend Architecture (+14 more)

### Community 12 - "echarts.min.js"
Cohesion: 0.02
Nodes (141): Ab(), aR(), at(), au(), Ax(), ay(), bB(), BD() (+133 more)

### Community 13 - "logging.php"
Cohesion: 0.40
Nodes (4): Monolog\Handler\NullHandler, Monolog\Handler\StreamHandler, Monolog\Handler\SyslogUdpHandler, Monolog\Processor\PsrLogMessageProcessor

### Community 14 - "lord-icon-2.1.0.js"
Cohesion: 0.02
Nodes (55): addDecorator(), boxIntersect(), checkReady(), createNS(), createProxyFunction(), createSizedArray(), crossProduct(), CVCompElement() (+47 more)

### Community 16 - "SseParserTest"
Cohesion: 0.10
Nodes (3): PHPUnit\Framework\TestCase, ExampleTest, SseParserTest

### Community 18 - "Illuminate\Http\Request"
Cohesion: 0.07
Nodes (31): AuthenticatedSessionController, ConfirmablePasswordController, EmailVerificationNotificationController, EmailVerificationPromptController, NewPasswordController, PasswordController, PasswordResetLinkController, RegisteredUserController (+23 more)

### Community 19 - "chart.umd.js"
Cohesion: 0.03
Nodes (71): afterEvent(), ai(), at(), average(), beforeDraw(), beforeUpdate(), ca, dataset() (+63 more)

### Community 25 - "item-detail.js"
Cohesion: 0.13
Nodes (26): close(), initializeGuestPage(), onInput(), onKeyDown(), performSearch(), scrollActive(), bootstrapItemDetail(), chartEl (+18 more)

### Community 27 - "tn"
Cohesion: 0.04
Nodes (16): d(), da(), Ie(), ke(), kn(), Ni(), onClick(), Pn() (+8 more)

### Community 28 - "index.global.min.js"
Cohesion: 0.04
Nodes (79): ai(), Ao(), b(), be(), bl, Br(), Bs(), di() (+71 more)

### Community 29 - "i"
Cohesion: 0.09
Nodes (88): aA(), ac(), c(), p(), An(), n(), B(), ba() (+80 more)

### Community 30 - "p"
Cohesion: 0.04
Nodes (37): A(), at(), bo, cl(), componentWillUnmount(), dl, ec(), fc() (+29 more)

### Community 31 - "swiper-bundle.min.js"
Cohesion: 0.09
Nodes (55): a(), addEventListener(), b(), blur(), c(), C(), cancelAnimationFrame(), ce() (+47 more)

### Community 32 - "moment.min.js"
Cohesion: 0.06
Nodes (72): tn(), a(), Ae(), an(), at(), b(), be(), bt() (+64 more)

### Community 33 - "apexcharts.min.js"
Cohesion: 0.03
Nodes (52): _addRunner(), amove(), array(), attr(), ax(), ay(), bi, cancelImmediate() (+44 more)

### Community 34 - "ei"
Cohesion: 0.07
Nodes (5): ei, ft(), gt(), hr(), ya()

### Community 35 - "c"
Cohesion: 0.05
Nodes (10): s(), t(), b(), c(), createTag(), substr(), s(), n() (+2 more)

### Community 36 - "Hn"
Cohesion: 0.08
Nodes (17): an(), bc(), da(), en, er, getMarkerDay(), getMarkerMonth(), getMarkerYear() (+9 more)

### Community 37 - "pi"
Cohesion: 0.05
Nodes (17): aa(), batchRendering(), constructor(), cs, dc(), eo(), events(), ka() (+9 more)

### Community 38 - "Y"
Cohesion: 0.07
Nodes (40): Al(), bk(), bv(), Cr(), Cw(), di(), Dr(), Dw() (+32 more)

### Community 39 - "t"
Cohesion: 0.08
Nodes (66): a(), b(), bt(), ct(), d(), dt(), e(), f() (+58 more)

### Community 40 - "Qe"
Cohesion: 0.08
Nodes (14): animate(), cancelFrame(), frame(), je, plot(), Qe, _queueNumberDelta(), _queueObject() (+6 more)

### Community 41 - ".constructor"
Cohesion: 0.06
Nodes (13): ar(), Bi(), destroy(), ja, ji(), ns(), os, Qa (+5 more)

### Community 42 - "moment.js"
Cohesion: 0.04
Nodes (38): RFC-2822, add$1(), addSubtract$1(), addTimeToArrayFromToken(), extractFromRFC2822Strings(), get$1(), getParseRegexForToken(), hasOwnProp() (+30 more)

### Community 43 - "e"
Cohesion: 0.09
Nodes (25): A(), br(), e(), ce(), da(), dd(), er(), n() (+17 more)

### Community 44 - "bt"
Cohesion: 0.05
Nodes (19): b(), bt, clipWith(), dmove(), J(), li, linker(), linkTo() (+11 more)

### Community 45 - "l"
Cohesion: 0.07
Nodes (20): aa(), Ae(), afterDatasetsUpdate(), afterDraw(), Ba, Bi(), Ci(), cs (+12 more)

### Community 46 - "bootstrap.bundle.min.js"
Cohesion: 0.09
Nodes (50): be(), Ce(), D(), De(), _e(), ei(), Fe(), fi() (+42 more)

### Community 47 - "Sl"
Cohesion: 0.05
Nodes (18): bt(), cc(), ct(), Ht(), ic(), il(), is, jl (+10 more)

### Community 48 - "q"
Cohesion: 0.06
Nodes (43): Ad(), Am(), ao(), bf(), Bs(), a(), cb(), db() (+35 more)

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
Cohesion: 0.06
Nodes (48): az(), Cl(), ct(), Dk(), Dl(), E(), el(), en() (+40 more)

### Community 53 - "User"
Cohesion: 0.05
Nodes (22): User, Illuminate\Auth\Notifications\ResetPassword, Illuminate\Foundation\Auth\User, Illuminate\Foundation\Testing\RefreshDatabase, Illuminate\Foundation\Testing\TestCase, Illuminate\Support\Facades\Event, Illuminate\Support\Facades\Hash, Illuminate\Support\Facades\Http (+14 more)

### Community 54 - "vt"
Cohesion: 0.08
Nodes (3): ls, mt(), vt

### Community 55 - ".bbox"
Cohesion: 0.06
Nodes (18): center(), cy(), dx(), dy(), ee(), ge, hi, ie() (+10 more)

### Community 56 - ".init"
Cohesion: 0.07
Nodes (15): as(), createPointHandles(), createResizeHandles(), createRotationHandle(), draggable(), Fe, init(), is() (+7 more)

### Community 57 - "xt"
Cohesion: 0.07
Nodes (12): ft(), getEventHolder(), gt(), It(), ki, Pe(), Rt, Tt() (+4 more)

### Community 58 - ".add"
Cohesion: 0.06
Nodes (30): Mr(), ac(), cr(), dr(), ea(), expand(), fr, it() (+22 more)

### Community 59 - "E"
Cohesion: 0.10
Nodes (14): a(), b(), c(), E, g(), k(), l(), n() (+6 more)

### Community 60 - "us"
Cohesion: 0.07
Nodes (4): getSelectorFromElement(), Rt, us, Y

### Community 61 - "t"
Cohesion: 0.08
Nodes (25): a(), At(), c(), constructor(), Ct, d(), _draw(), Dt (+17 more)

### Community 62 - "shepherd.min.js"
Cohesion: 0.07
Nodes (41): Bb(), Bc(), Cb(), g(), Da(), ec, F(), fa() (+33 more)

### Community 63 - "oi"
Cohesion: 0.08
Nodes (9): et(), fa(), Ke(), Me, oi(), R(), tt(), We() (+1 more)

### Community 64 - "n"
Cohesion: 0.07
Nodes (11): ei(), en, fn(), gn(), je(), n(), Oe(), qe() (+3 more)

### Community 65 - "ro"
Cohesion: 0.19
Nodes (6): ao(), co(), Do(), inXRange(), inYRange(), ro()

### Community 66 - ".constructor"
Cohesion: 0.09
Nodes (14): al, Cn(), co, componentDidUpdate(), flushScrollReset(), fn(), ga(), ha (+6 more)

### Community 67 - "sweetalert2.min.js"
Cohesion: 0.09
Nodes (18): dt(), e(), emit(), En, Ft(), _getHandlersByEventName(), _main(), mt() (+10 more)

### Community 68 - ".hide"
Cohesion: 0.14
Nodes (3): fo, Q, lo()

### Community 69 - "Sortable.min.js"
Cohesion: 0.13
Nodes (25): a(), b(), Bt(), D(), e(), f(), g(), h() (+17 more)

### Community 70 - "pa"
Cohesion: 0.12
Nodes (4): ba(), Ge(), Ie(), pa()

### Community 71 - "updateElements"
Cohesion: 0.07
Nodes (25): beforeDatasetDraw(), beforeDatasetsDraw(), Bn(), _calculateBarIndexPixels(), _calculateBarValuePixels(), es(), generateLabels(), getBasePixel() (+17 more)

### Community 72 - "a"
Cohesion: 0.05
Nodes (21): a(), afterUpdate(), beforeLayout(), buildLookupTable(), determineDataLimits(), Di(), g(), _generate() (+13 more)

### Community 73 - "U"
Cohesion: 0.08
Nodes (59): bi(), bl(), cc(), Dm(), Ew(), ez(), fg(), g() (+51 more)

### Community 74 - "xt"
Cohesion: 0.10
Nodes (6): an(), as(), on, rs(), ts(), xt

### Community 75 - "zt"
Cohesion: 0.09
Nodes (14): Bt(), color(), Ft(), Gt(), It(), jt(), kt(), mt() (+6 more)

### Community 76 - "dom-autoscroller.min.js"
Cohesion: 0.13
Nodes (29): a(), c(), d(), e(), f(), h(), i(), n() (+21 more)

### Community 77 - "El"
Cohesion: 0.12
Nodes (6): ci(), El, ml(), pl(), rl(), ul()

### Community 78 - "leaflet.js"
Cohesion: 0.07
Nodes (7): a(), Ci(), ei(), ii(), l(), ri(), x()

### Community 79 - "localeData"
Cohesion: 0.09
Nodes (30): addFormatToken(), addWeekYearFormatToken(), expandFormat(), replaceLongDateFormatTokens(), format(), formatMoment(), from(), fromNow() (+22 more)

### Community 80 - "getParsingFlags"
Cohesion: 0.11
Nodes (30): calculateOffset(), checkOverflow(), checkWeekday(), configFromInput(), configFromISO(), configFromRFC2822(), configFromString(), configFromStringAndArray() (+22 more)

### Community 81 - "kn"
Cohesion: 0.16
Nodes (3): d(), kn, Tn()

### Community 82 - "isValid"
Cohesion: 0.10
Nodes (40): clone(), cloneWithOffset(), createLocal(), createUnix(), diff(), endOf(), get$2(), getCalendarFormat() (+32 more)

### Community 83 - "c"
Cohesion: 0.15
Nodes (27): ac(), B(), Ca(), cc(), d(), e(), f(), h() (+19 more)

### Community 84 - "dragula.min.js"
Cohesion: 0.21
Nodes (27): a(), b(), c(), D(), E(), ee(), F(), n() (+19 more)

### Community 85 - "createDuration"
Cohesion: 0.10
Nodes (26): absRound(), addParseToken(), addSubtract(), addWeekParseToken(), clone$1(), createDuration(), createInvalid$1(), daysInMonth() (+18 more)

### Community 86 - "update"
Cohesion: 0.07
Nodes (28): addBox(), b(), buildTicks(), cn(), configure(), eo(), f(), hn() (+20 more)

### Community 87 - "glightbox.min.js"
Cohesion: 0.23
Nodes (23): a(), b(), c(), d(), e(), f(), g(), h() (+15 more)

### Community 88 - "ta"
Cohesion: 0.10
Nodes (7): Ga(), kc(), sa(), ta(), Wa(), X(), Xa()

### Community 90 - "_l"
Cohesion: 0.16
Nodes (23): ap(), cp(), dp(), Dy(), ep(), fp(), hp(), I() (+15 more)

### Community 91 - "ms"
Cohesion: 0.11
Nodes (6): ds, gr(), ms(), ps(), us(), wl

### Community 92 - "X"
Cohesion: 0.07
Nodes (36): aw(), Bx(), Cf(), fk(), gE(), gh(), Gx(), Hx() (+28 more)

### Community 93 - "quill.min.js"
Cohesion: 0.44
Nodes (23): a(), b(), c(), d(), e(), f(), f(), g() (+15 more)

### Community 94 - "render"
Cohesion: 0.16
Nodes (9): Bn, Hl, no(), render(), renderEmptyMessage(), renderSegList(), tl, to() (+1 more)

### Community 95 - "MaterialDesign-Webfont-7.4.47/package.json"
Cohesion: 0.08
Nodes (23): author, name, web, bugs, url, description, homepage, keywords (+15 more)

### Community 97 - "apps/js/app.js"
Cohesion: 0.17
Nodes (16): b(), c(), D(), s(), E(), G(), i(), l() (+8 more)

### Community 99 - "HomeController"
Cohesion: 0.13
Nodes (5): HomeController, ItemSearchService, TopItemsThisWeekService, Illuminate\Support\Collection, Illuminate\Support\Facades\Cache

### Community 100 - "ug"
Cohesion: 0.18
Nodes (14): ag(), bp(), dg(), eg(), hg(), lg(), mp(), ng() (+6 more)

### Community 101 - "Qn"
Cohesion: 0.09
Nodes (8): componentDidMount(), fl, jn(), Qn(), updateSize(), ws, yo, ze()

### Community 102 - "rn"
Cohesion: 0.28
Nodes (3): on, rn(), sn

### Community 103 - "n"
Cohesion: 0.32
Nodes (19): a(), e(), i(), n(), c(), d(), f(), i() (+11 more)

### Community 104 - "Gs"
Cohesion: 0.23
Nodes (3): getElementFromSelector(), Gs, qs()

### Community 107 - "Illuminate\Support\Str"
Cohesion: 0.09
Nodes (14): ItemFactory, ListingFactory, UserFactory, Illuminate\Database\Eloquent\Attributes\Fillable, Illuminate\Database\Eloquent\Attributes\Hidden, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Eloquent\Model (+6 more)

### Community 108 - "getLocale"
Cohesion: 0.17
Nodes (16): chooseLocale(), compareArrays(), createAdder(), defineLocale(), deprecate(), deprecateSimple(), Duration(), getLocale() (+8 more)

### Community 109 - "simplebar.min.js"
Cohesion: 0.21
Nodes (11): a(), e(), i(), S(), b(), f(), g(), m() (+3 more)

### Community 110 - "initiateExpression"
Cohesion: 0.14
Nodes (8): initialize$2(), initiateExpression(), applyEase(), ease(), easeIn(), easeOut(), executeExpression(), seedRandom()

### Community 111 - "remove"
Cohesion: 0.09
Nodes (3): H, remove(), ts

### Community 113 - "Wt"
Cohesion: 0.16
Nodes (15): be(), bh(), bn(), Fh(), Ie(), Se(), Ss(), vi() (+7 more)

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

### Community 121 - "E"
Cohesion: 0.35
Nodes (14): E(), Eb(), Fb(), G(), Hb(), ib(), J(), Ja() (+6 more)

### Community 122 - "LoginRequest"
Cohesion: 0.17
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

### Community 128 - "isFunction"
Cohesion: 0.15
Nodes (14): addRegexToken(), calendar(), calendar$1(), configFromObject(), getPrioritizedUnits(), isFunction(), makeFormatFunction(), normalizeObjectUnits() (+6 more)

### Community 131 - "A"
Cohesion: 0.08
Nodes (29): cA(), D(), dc(), eo(), Fm(), Hh(), o(), ic() (+21 more)

### Community 132 - "calendar.init.js"
Cohesion: 0.20
Nodes (3): getTime(), tConvert(), upcomingEvent()

### Community 133 - "file-manager.init.js"
Cohesion: 0.27
Nodes (8): editFileList(), favouriteBtn(), fetchIdFromObj(), fileDetailShow(), loadFileData(), removefileOverview(), removeSingleItem(), sortElementsById()

### Community 135 - "landing.init.js"
Cohesion: 0.17
Nodes (3): counter(), menuToggle, navLinks

### Community 137 - "ListingIngestService"
Cohesion: 0.25
Nodes (3): ListingIngestService, Carbon, Illuminate\Support\Carbon

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

### Community 164 - "createUTC"
Cohesion: 0.24
Nodes (9): computeMonthsParse(), computeWeekdaysParse(), cmpLenRev(), createUTC(), handleStrictParse(), handleStrictParse$1(), localeMonthsParse(), localeWeekdaysParse() (+1 more)

### Community 165 - "fn"
Cohesion: 0.33
Nodes (9): $a(), ab(), D(), db(), fn(), ha(), ia(), Y() (+1 more)

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

### Community 185 - "as"
Cohesion: 0.25
Nodes (9): absCeil(), absFloor(), as(), bubble(), daysToMonths(), makeAs(), monthsToDays(), relativeTime$1() (+1 more)

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

### Community 228 - "i"
Cohesion: 1.00
Nodes (3): i(), Mi(), zi()

### Community 350 - "DatabaseSeeder"
Cohesion: 0.31
Nodes (4): DatabaseSeeder, UsersTableSeeder, Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Seeder

### Community 351 - "fs"
Cohesion: 0.25
Nodes (3): fs(), kn(), zl

### Community 352 - "StreamGrowtopiaListings.php"
Cohesion: 0.20
Nodes (9): GuzzleHttp\Exception\GuzzleException, Illuminate\Console\Attributes\Description, Illuminate\Console\Attributes\Signature, Illuminate\Console\Command, Illuminate\Database\UniqueConstraintViolationException, Illuminate\Http\Client\ConnectionException, Illuminate\Support\Arr, Illuminate\Support\Facades\Log (+1 more)

### Community 353 - "extra"
Cohesion: 0.67
Nodes (3): extra, laravel, dont-discover

### Community 355 - "HSVtoRGB"
Cohesion: 0.60
Nodes (5): addBrightnessToRGB(), addHueToRGB(), addSaturationToRGB(), HSVtoRGB(), RGBtoHSV()

## Knowledge Gaps
- **152 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+147 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **49 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Et()` connect `Lt` to `apexcharts.min.js`, `gridjs.umd.js`, `zt`?**
  _High betweenness centrality (0.079) - this node is a cross-community bridge._
- **Why does `Bt()` connect `zt` to `Lt`, `chart.umd.js`?**
  _High betweenness centrality (0.056) - this node is a cross-community bridge._
- **Why does `Oi()` connect `l` to `Sl`, `chart.umd.js`, `Ki`, `p`, `.add`, `index.global.min.js`, `render`?**
  _High betweenness centrality (0.040) - this node is a cross-community bridge._
- **Are the 10 inferred relationships involving `E()` (e.g. with `r()` and `p()`) actually correct?**
  _`E()` has 10 INFERRED edges - model-reasoned connections that need verification._
- **Are the 7 inferred relationships involving `p()` (e.g. with `gi()` and `N()`) actually correct?**
  _`p()` has 7 INFERRED edges - model-reasoned connections that need verification._
- **Are the 66 inferred relationships involving `i()` (e.g. with `A()` and `aA()`) actually correct?**
  _`i()` has 66 INFERRED edges - model-reasoned connections that need verification._
- **Are the 68 inferred relationships involving `a()` (e.g. with `A()` and `ac()`) actually correct?**
  _`a()` has 68 INFERRED edges - model-reasoned connections that need verification._