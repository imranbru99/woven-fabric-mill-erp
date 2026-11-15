# Modules and roles

The demo mill is `App\Services\MillFlow`. One call builds a Gazipur branch and walks 40×40 133×72 poplin from the inquiry to the receipt. `php artisan db:seed` runs that flow and publishes the public pages.

Sign in at `/admin` as `owner@mill.test` with password `password`. The same password is on every demo role: `weaving-manager@mill.test`, `buyer@mill.test`, `supplier@mill.test`, `loom-operator@mill.test`, and the rest of the role list in `MillFlow::roleCatalog()`. Accountant, accounts manager and auditor are marked for an authenticator. Their demo secrets are already confirmed so the panel opens; `/admin/two-factor` is the setup screen for a role that still needs it.

## Where the work lives

| Area | What to open |
|---|---|
| Marketing through the sales order | Filament group Marketing & Sales. Costing is `CostingService`. Feasibility is `PlanningService`. |
| Yarn, GRN, landed cost | Procurement and Inventory groups. Stock moves go through `StockService`. Landed cost is `LandedCostService`. |
| Plan, beam, loom | Planning group and the floor panel at `/floor`. |
| Warping, sizing, weaving, inspection, job-work, packing | Production group. The technical sheet is `WeavingMath`, filled when an article is saved. |
| Laboratory and claims | Quality group. A failed yarn test and an open buyer claim are in the demo. |
| Maintenance, power, ETP | Maintenance group. |
| Dispatch, invoice, gate | Dispatch & Gate group. PDFs are `DocumentPdfService` at `/documents/{kind}/{id}` while signed in. |
| Ledger and order profit | Accounts group. Journals are posted only by `PostingService`. The report library is under Accounts and runs the named reports in `ReportCatalog`. |
| People and wages | HR & Payroll group. Piece pay is `PayrollService`. |
| Issues | Issues group, including the morning meeting page. Rules are `IssueEngine`. `php artisan mill:evaluate-issues` runs them again. |
| Public site | `/`, `/fabrics`, `/machinery`, `/sample-request`, `/rfq`, `/careers`. Forms create a lead and an inquiry, or a job application. |
| Buyer and supplier | `/buyer` and `/supplier`, limited to the party with the same email. |
| API | Sanctum routes under `/api`: floor production and stoppage, gate scan, warehouse receive, buyer orders, loom-monitor import. Interactive docs are at `/docs/api` when Scramble is available. |

A roll number is the join. `TraceabilityService::fromRoll()` returns the loom, operator, beam, sizing batch and both yarn lots.

## Panels

- `/admin` — internal roles.
- `/buyer` — buyer role, owner, merchandiser.
- `/supplier` — supplier role and the purchase manager.
- `/floor` — loom operators and the weaving supervisors, large stop buttons with Bangla labels.
- `/shell` — the packaged admin shell, separate from the ERP.

Cost, rate, wage and ledger amount fields stay hidden unless the role is owner, managing director, accounts, auditor, commercial, merchandiser or IT, or holds the `view-costs` permission.
