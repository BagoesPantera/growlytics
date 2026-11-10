# Graph Report - growlytics  (2026-11-10)

## Corpus Check
- 313 files · ~1,660,582 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 5971 nodes · 14341 edges · 355 communities (307 shown, 48 thin omitted)
- Extraction: 89% EXTRACTED · 11% INFERRED · 0% AMBIGUOUS · INFERRED: 1510 edges (avg confidence: 0.85)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `277cc941`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Illuminate\Database\Migrations\Migration
- composer.json
- de
- devDependencies
- X
- ListingIngestService
- ItemController
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
- q
- bt
- a
- bootstrap.bundle.min.js
- Sl
- E
- a
- gridjs.umd.js
- he
- e
- User
- vt
- .bbox
- .init
- xt
- fr
- E
- us
- t
- shepherd.min.js
- oi
- n
- .getContext
- fo
- sweetalert2.min.js
- ro
- Sortable.min.js
- pa
- s
- ho
- Wt
- xt
- zt
- dom-autoscroller.min.js
- y
- leaflet.js
- isValid
- getParsingFlags
- remove
- createLocal
- c
- dragula.min.js
- createDuration
- Ba
- glightbox.min.js
- ta
- Lt
- _l
- r
- U
- quill.min.js
- inRange
- MaterialDesign-Webfont-7.4.47/package.json
- lc
- apps/js/app.js
- sn
- HomeController
- ug
- Qn
- o
- n
- Gs
- TopItemsThisWeekTest
- dn
- Item.php
- hasOwnProp
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
- Z
- LoginRequest
- $bm_isInstanceOfArray
- ks
- F
- scripts
- tasks-list.init.js
- isFunction
- .newLine
- st
- A
- calendar.init.js
- file-manager.init.js
- landing.init.js
- ticketlist.init.js
- GrowlyticsStreamCommandTest
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
- r
- as
- Jt
- rn
- createUTC
- .defs
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
- fn
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
- eo
- extra
- rn

## God Nodes (most connected - your core abstractions)
1. `E()` - 135 edges
2. `tn` - 124 edges
3. `p()` - 83 edges
4. `i()` - 82 edges
5. `a()` - 76 edges
6. `o()` - 71 edges
7. `r()` - 70 edges
8. `Item` - 69 edges
9. `c()` - 68 edges
10. `e()` - 68 edges

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

## Communities (355 total, 48 thin omitted)

### Community 0 - "Illuminate\Database\Migrations\Migration"
Cohesion: 0.13
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

### Community 1 - "composer.json"
Cohesion: 0.14
Nodes (13): autoload-dev, psr-4, description, keywords, license, minimum-stability, name, prefer-stable (+5 more)

### Community 2 - "de"
Cohesion: 0.33
Nodes (3): ce(), de, he()

### Community 3 - "devDependencies"
Cohesion: 0.06
Nodes (31): alpinejs, autoprefixer, concurrently, echarts, @laravel/multiplex, laravel-vite-plugin, dependencies, echarts (+23 more)

### Community 4 - "X"
Cohesion: 0.07
Nodes (36): aw(), Bx(), Cf(), fk(), gE(), gh(), Gx(), Hx() (+28 more)

### Community 5 - "ListingIngestService"
Cohesion: 0.06
Nodes (21): BackfillItemSlugs, StreamGrowtopiaListings, RoleMiddleware, ListingIngestService, Carbon, SseEvent, SseParser, Closure (+13 more)

### Community 6 - "ItemController"
Cohesion: 0.14
Nodes (7): ItemController, ItemPriceHistoryService, Carbon, ItemRecentWorldListingsService, ItemSearchService, Illuminate\Http\JsonResponse, Illuminate\Support\Collection

### Community 7 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 9 - "Item"
Cohesion: 0.09
Nodes (7): Item, static, Listing, ItemPriceHistoryTest, ItemRecentWorldsTest, ItemSearchTest, ListingIngestServiceTest

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
Nodes (60): addBrightnessToRGB(), addDecorator(), addHueToRGB(), addSaturationToRGB(), boxIntersect(), checkReady(), createNS(), createProxyFunction() (+52 more)

### Community 16 - "SseParserTest"
Cohesion: 0.10
Nodes (3): PHPUnit\Framework\TestCase, ExampleTest, SseParserTest

### Community 18 - "Illuminate\Http\Request"
Cohesion: 0.05
Nodes (32): DashboardController, AuthenticatedSessionController, ConfirmablePasswordController, EmailVerificationNotificationController, EmailVerificationPromptController, NewPasswordController, PasswordController, PasswordResetLinkController (+24 more)

### Community 19 - "chart.umd.js"
Cohesion: 0.03
Nodes (51): ai(), at(), b(), beforeDatasetDraw(), beforeDatasetsDraw(), beforeDraw(), beforeUpdate(), buildTicks() (+43 more)

### Community 25 - "item-detail.js"
Cohesion: 0.13
Nodes (26): close(), initializeGuestPage(), onInput(), onKeyDown(), performSearch(), scrollActive(), bootstrapItemDetail(), chartEl (+18 more)

### Community 27 - "tn"
Cohesion: 0.04
Nodes (16): addBox(), configure(), d(), Di(), dt(), ke(), kn(), onClick() (+8 more)

### Community 28 - "index.global.min.js"
Cohesion: 0.03
Nodes (74): Mr(), ac(), ai(), at(), be(), Br(), Cn(), co (+66 more)

### Community 29 - "i"
Cohesion: 0.09
Nodes (88): aA(), ac(), c(), p(), An(), n(), B(), ba() (+80 more)

### Community 30 - "p"
Cohesion: 0.05
Nodes (52): b(), Bn, ci(), cl(), componentWillUnmount(), di(), E(), s() (+44 more)

### Community 31 - "swiper-bundle.min.js"
Cohesion: 0.09
Nodes (55): a(), addEventListener(), b(), blur(), c(), C(), cancelAnimationFrame(), ce() (+47 more)

### Community 32 - "moment.min.js"
Cohesion: 0.06
Nodes (72): tn(), a(), Ae(), an(), at(), b(), be(), bt() (+64 more)

### Community 33 - "apexcharts.min.js"
Cohesion: 0.04
Nodes (41): _addRunner(), amove(), array(), attr(), ax(), ay(), cancelImmediate(), _clearTransformRunnersBefore() (+33 more)

### Community 34 - "ei"
Cohesion: 0.07
Nodes (7): ei, er, ft(), gt(), hr(), parse(), ya()

### Community 35 - "c"
Cohesion: 0.05
Nodes (10): s(), t(), b(), c(), createTag(), substr(), s(), n() (+2 more)

### Community 36 - "Hn"
Cohesion: 0.05
Nodes (22): an(), bc(), bo, ct(), da(), ec(), en, getMarkerDay() (+14 more)

### Community 37 - "pi"
Cohesion: 0.05
Nodes (19): aa(), batchRendering(), constructor(), cs, dc(), events(), ia(), ka() (+11 more)

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
Cohesion: 0.05
Nodes (12): A(), Bi(), destroy(), ja, ji(), ns(), os, Qa (+4 more)

### Community 42 - "moment.js"
Cohesion: 0.04
Nodes (35): RFC-2822, add$1(), addParseToken(), addSubtract$1(), addWeekParseToken(), extractFromRFC2822Strings(), get$1(), isNumber() (+27 more)

### Community 43 - "q"
Cohesion: 0.06
Nodes (43): Ad(), Am(), ao(), bf(), Bs(), a(), cb(), db() (+35 more)

### Community 44 - "bt"
Cohesion: 0.05
Nodes (23): b(), bi, bt, clipWith(), componentTransfer(), fontface(), J(), linker() (+15 more)

### Community 45 - "a"
Cohesion: 0.07
Nodes (24): a(), aa(), Ae(), afterDatasetsUpdate(), afterUpdate(), draw(), Ee(), fo() (+16 more)

### Community 46 - "bootstrap.bundle.min.js"
Cohesion: 0.09
Nodes (50): be(), Ce(), D(), De(), _e(), ei(), Fe(), fi() (+42 more)

### Community 47 - "Sl"
Cohesion: 0.06
Nodes (11): bt(), cc(), ic(), is, jl, mt(), nc, pt() (+3 more)

### Community 48 - "E"
Cohesion: 0.06
Nodes (48): az(), Cl(), ct(), Dk(), Dl(), E(), el(), en() (+40 more)

### Community 49 - "a"
Cohesion: 0.06
Nodes (27): a(), addPropertyDecorator(), e(), i(), l(), r(), d(), e() (+19 more)

### Community 50 - "gridjs.umd.js"
Cohesion: 0.15
Nodes (50): a(), At(), b(), bt(), C(), Cn(), Ct(), dn() (+42 more)

### Community 51 - "he"
Cohesion: 0.04
Nodes (15): active(), ai, ce, ci, clearTimeout(), fi, he, ke (+7 more)

### Community 52 - "e"
Cohesion: 0.09
Nodes (25): A(), br(), e(), ce(), da(), dd(), er(), n() (+17 more)

### Community 53 - "User"
Cohesion: 0.06
Nodes (21): User, Carbon\Carbon, Illuminate\Auth\Events\Verified, Illuminate\Auth\Notifications\ResetPassword, Illuminate\Foundation\Auth\User, Illuminate\Foundation\Testing\RefreshDatabase, Illuminate\Foundation\Testing\TestCase, Illuminate\Support\Facades\Cache (+13 more)

### Community 54 - "vt"
Cohesion: 0.07
Nodes (4): ls, mt(), Ut, vt

### Community 55 - ".bbox"
Cohesion: 0.06
Nodes (14): cy(), dx(), dy(), ee(), ge, hi, ie(), Ja (+6 more)

### Community 56 - ".init"
Cohesion: 0.07
Nodes (18): as(), center(), createPointHandles(), createResizeHandles(), createRotationHandle(), draggable(), Fe, init() (+10 more)

### Community 57 - "xt"
Cohesion: 0.06
Nodes (13): Dt, ft(), getEventHolder(), gt(), It(), ki, Pe(), Rt (+5 more)

### Community 58 - "fr"
Cohesion: 0.06
Nodes (18): ea(), fr, ga(), ha, Ko(), lr(), ma(), mn() (+10 more)

### Community 59 - "E"
Cohesion: 0.10
Nodes (14): a(), b(), c(), E, g(), k(), l(), n() (+6 more)

### Community 61 - "t"
Cohesion: 0.10
Nodes (24): a(), At(), c(), constructor(), Ct, d(), _draw(), e() (+16 more)

### Community 62 - "shepherd.min.js"
Cohesion: 0.08
Nodes (38): Bb(), Bc(), Cb(), g(), Da(), ec, F(), fa() (+30 more)

### Community 63 - "oi"
Cohesion: 0.07
Nodes (10): et(), fa(), Ke(), Me, oi(), R(), tt(), ua (+2 more)

### Community 64 - "n"
Cohesion: 0.06
Nodes (12): Be(), ei(), en, fn(), g(), gn(), n(), ne() (+4 more)

### Community 65 - ".getContext"
Cohesion: 0.10
Nodes (14): ao(), Bi(), Ci(), co(), cs, da(), Do(), Fi() (+6 more)

### Community 67 - "sweetalert2.min.js"
Cohesion: 0.09
Nodes (18): dt(), e(), emit(), En, Ft(), _getHandlersByEventName(), _main(), mt() (+10 more)

### Community 68 - "ro"
Cohesion: 0.14
Nodes (3): Qs(), ro, ws

### Community 69 - "Sortable.min.js"
Cohesion: 0.13
Nodes (25): a(), b(), Bt(), D(), e(), f(), g(), h() (+17 more)

### Community 71 - "s"
Cohesion: 0.05
Nodes (30): Bn(), bo, _calculateBarIndexPixels(), _calculateBarValuePixels(), determineDataLimits(), es(), generateLabels(), getLabelAndValue() (+22 more)

### Community 72 - "ho"
Cohesion: 0.08
Nodes (13): beforeLayout(), buildLookupTable(), _generate(), getDecimalForValue(), _getTimestampsForTable(), getValueForPixel(), Go(), ho() (+5 more)

### Community 73 - "Wt"
Cohesion: 0.16
Nodes (15): be(), bh(), bn(), Fh(), Ie(), Se(), Ss(), vi() (+7 more)

### Community 74 - "xt"
Cohesion: 0.09
Nodes (7): an(), as(), ln(), on, rs(), ts(), xt

### Community 75 - "zt"
Cohesion: 0.09
Nodes (14): Bt(), color(), Ft(), Gt(), It(), jt(), kt(), mt() (+6 more)

### Community 76 - "dom-autoscroller.min.js"
Cohesion: 0.13
Nodes (29): a(), c(), d(), e(), f(), h(), i(), n() (+21 more)

### Community 77 - "y"
Cohesion: 0.05
Nodes (17): dl, El, ii(), kl, ml(), ol(), oo(), pl() (+9 more)

### Community 78 - "leaflet.js"
Cohesion: 0.07
Nodes (7): a(), Ci(), ei(), ii(), l(), ri(), x()

### Community 79 - "isValid"
Cohesion: 0.10
Nodes (33): addFormatToken(), addWeekYearFormatToken(), format(), formatMoment(), from(), fromNow(), getSetDayOfWeek(), getSetISODayOfWeek() (+25 more)

### Community 80 - "getParsingFlags"
Cohesion: 0.10
Nodes (33): calculateOffset(), checkOverflow(), checkWeekday(), configFromInput(), configFromISO(), configFromRFC2822(), configFromString(), configFromStringAndArray() (+25 more)

### Community 81 - "remove"
Cohesion: 0.09
Nodes (6): getSelectorFromElement(), d(), kn, remove(), Rt, Tn()

### Community 82 - "createLocal"
Cohesion: 0.13
Nodes (31): clone(), cloneWithOffset(), createLocal(), createUnix(), diff(), endOf(), get$2(), getCalendarFormat() (+23 more)

### Community 83 - "c"
Cohesion: 0.12
Nodes (26): ac(), B(), Ca(), cc(), d(), e(), f(), h() (+18 more)

### Community 84 - "dragula.min.js"
Cohesion: 0.21
Nodes (27): a(), b(), c(), D(), E(), ee(), F(), n() (+19 more)

### Community 85 - "createDuration"
Cohesion: 0.11
Nodes (23): absRound(), addSubtract(), clone$1(), createDuration(), createInvalid$1(), daysInMonth(), get(), getDateOffset() (+15 more)

### Community 86 - "Ba"
Cohesion: 0.12
Nodes (17): afterDraw(), afterEvent(), Ba, eo(), f(), g(), ko(), m() (+9 more)

### Community 87 - "glightbox.min.js"
Cohesion: 0.23
Nodes (23): a(), b(), c(), d(), e(), f(), g(), h() (+15 more)

### Community 88 - "ta"
Cohesion: 0.12
Nodes (6): Ga(), sa(), ta(), Wa(), X(), Xa()

### Community 90 - "_l"
Cohesion: 0.16
Nodes (23): ap(), cp(), dp(), Dy(), ep(), fp(), hp(), I() (+15 more)

### Community 91 - "r"
Cohesion: 0.10
Nodes (15): ar(), bl, Bs(), ds, fs(), gl(), r(), gs() (+7 more)

### Community 92 - "U"
Cohesion: 0.08
Nodes (59): bi(), bl(), cc(), Dm(), Ew(), ez(), fg(), g() (+51 more)

### Community 93 - "quill.min.js"
Cohesion: 0.44
Nodes (23): a(), b(), c(), d(), e(), f(), f(), g() (+15 more)

### Community 94 - "inRange"
Cohesion: 0.14
Nodes (18): average(), dataset(), getCenterPoint(), index(), inRange(), K(), li(), nearest() (+10 more)

### Community 95 - "MaterialDesign-Webfont-7.4.47/package.json"
Cohesion: 0.08
Nodes (23): author, name, web, bugs, url, description, homepage, keywords (+15 more)

### Community 97 - "apps/js/app.js"
Cohesion: 0.17
Nodes (16): b(), c(), D(), s(), E(), G(), i(), l() (+8 more)

### Community 98 - "sn"
Cohesion: 0.13
Nodes (4): addElements(), removeBox(), sn, stop()

### Community 100 - "ug"
Cohesion: 0.18
Nodes (14): ag(), bp(), dg(), eg(), hg(), lg(), mp(), ng() (+6 more)

### Community 101 - "Qn"
Cohesion: 0.06
Nodes (14): al, ba(), componentDidMount(), componentDidUpdate(), fl, flushScrollReset(), Ge(), Ie() (+6 more)

### Community 102 - "o"
Cohesion: 0.09
Nodes (25): bs(), ct(), dn(), e(), fe(), Fs(), ge(), gi() (+17 more)

### Community 103 - "n"
Cohesion: 0.32
Nodes (19): a(), e(), i(), n(), c(), d(), f(), i() (+11 more)

### Community 104 - "Gs"
Cohesion: 0.23
Nodes (3): getElementFromSelector(), Gs, qs()

### Community 107 - "Item.php"
Cohesion: 0.12
Nodes (12): ItemFactory, ListingFactory, static, UserFactory, Illuminate\Database\Eloquent\Attributes\Fillable, Illuminate\Database\Eloquent\Attributes\Hidden, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Database\Eloquent\Factories\HasFactory (+4 more)

### Community 108 - "hasOwnProp"
Cohesion: 0.13
Nodes (15): addTimeToArrayFromToken(), configFromObject(), Duration(), getParseRegexForToken(), getPrioritizedUnits(), hasOwnProp(), isDurationValid(), monthsRegex() (+7 more)

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

### Community 121 - "Z"
Cohesion: 0.33
Nodes (16): E(), Eb(), Fb(), G(), Hb(), ib(), J(), Ja() (+8 more)

### Community 122 - "LoginRequest"
Cohesion: 0.12
Nodes (9): LoginRequest, ProfileUpdateRequest, Illuminate\Auth\Events\Lockout, Illuminate\Contracts\Validation\ValidationRule, Illuminate\Foundation\Http\FormRequest, Illuminate\Support\Facades\RateLimiter, Illuminate\Support\Str, Illuminate\Validation\Rule (+1 more)

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
Cohesion: 0.22
Nodes (10): addRegexToken(), calendar(), calendar$1(), isFunction(), makeFormatFunction(), relativeTime(), removeFormattingTokens(), set() (+2 more)

### Community 129 - ".newLine"
Cohesion: 0.22
Nodes (3): dmove(), li, oi

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

### Community 160 - "r"
Cohesion: 0.17
Nodes (6): io(), no(), oo, pi(), r(), zi()

### Community 162 - "Jt"
Cohesion: 0.20
Nodes (10): Ae(), Ie(), Jt(), Le(), O(), Qt(), Re(), $t() (+2 more)

### Community 163 - "rn"
Cohesion: 0.28
Nodes (3): on, rn(), sn

### Community 164 - "createUTC"
Cohesion: 0.24
Nodes (9): computeMonthsParse(), computeWeekdaysParse(), cmpLenRev(), createUTC(), handleStrictParse(), handleStrictParse$1(), localeMonthsParse(), localeWeekdaysParse() (+1 more)

### Community 165 - ".defs"
Cohesion: 0.27
Nodes (5): defs(), gradient(), marker(), pattern(), si

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

### Community 193 - "fn"
Cohesion: 0.33
Nodes (9): $a(), ab(), D(), db(), fn(), ha(), ia(), Y() (+1 more)

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
Cohesion: 0.29
Nodes (4): Na(), Oa(), S, V()

### Community 228 - "i"
Cohesion: 1.00
Nodes (3): i(), Mi(), zi()

### Community 350 - "DatabaseSeeder"
Cohesion: 0.27
Nodes (5): DatabaseSeeder, UsersTableSeeder, Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Seeder, Illuminate\Support\Facades\DB

### Community 351 - "eo"
Cohesion: 0.31
Nodes (4): Ao(), Do(), eo(), Qe()

### Community 352 - "extra"
Cohesion: 0.67
Nodes (3): extra, laravel, dont-discover

## Knowledge Gaps
- **152 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+147 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **48 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Et()` connect `Lt` to `apexcharts.min.js`, `gridjs.umd.js`, `zt`?**
  _High betweenness centrality (0.078) - this node is a cross-community bridge._
- **Why does `Bt()` connect `zt` to `Lt`, `chart.umd.js`?**
  _High betweenness centrality (0.054) - this node is a cross-community bridge._
- **Why does `Oi()` connect `a` to `.constructor`, `Sl`, `remove`, `chart.umd.js`, `index.global.min.js`, `p`?**
  _High betweenness centrality (0.038) - this node is a cross-community bridge._
- **Are the 10 inferred relationships involving `E()` (e.g. with `r()` and `p()`) actually correct?**
  _`E()` has 10 INFERRED edges - model-reasoned connections that need verification._
- **Are the 7 inferred relationships involving `p()` (e.g. with `gi()` and `N()`) actually correct?**
  _`p()` has 7 INFERRED edges - model-reasoned connections that need verification._
- **Are the 66 inferred relationships involving `i()` (e.g. with `A()` and `aA()`) actually correct?**
  _`i()` has 66 INFERRED edges - model-reasoned connections that need verification._
- **Are the 68 inferred relationships involving `a()` (e.g. with `A()` and `ac()`) actually correct?**
  _`a()` has 68 INFERRED edges - model-reasoned connections that need verification._