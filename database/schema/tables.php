<?php

declare(strict_types=1);

/**
 * Source of truth for mill tables. Regenerate with `php scripts/generate.php`.
 *
 * @return array<int, array<string, mixed>>
 */
$tables = [];

$add = function (string $table, string $model, string $group, array $cols, array $opts = []) use (&$tables): void {
    $tables[] = array_merge([
        'table' => $table,
        'model' => $model,
        'group' => $group,
        'cols' => $cols,
    ], $opts);
};

$doc = [
    'string number unique',
    'string status default:draft index',
    'unsignedInteger version default:1',
    'datetime approved_at nullable',
    'foreignId approved_by users nullable',
];

$money = fn (string $name) => "decimal {$name} 18,2 default:0";
$qty = fn (string $name) => "decimal {$name} 18,3 default:0";
$rate = fn (string $name) => "decimal {$name} 18,4 default:0";

$add('currencies', 'Currency', 'Foundation', [
    'string code unique',
    'string name',
    'string symbol default:৳',
    'integer decimal_places default:2',
    'bool is_base default:0',
], ['nobranch' => true]);

$add('companies', 'Company', 'Foundation', [
    'string name',
    'string legal_name',
    'string country default:BD',
    'string currency_code default:BDT',
    'string timezone default:Asia/Dhaka',
    'string tax_id nullable',
    'string bin_vat nullable',
    'string address nullable',
    'string phone nullable',
    'string email nullable',
    'text about nullable',
], ['nobranch' => true]);

$add('branches', 'Branch', 'Foundation', [
    'foreignId company_id companies',
    'string code unique',
    'string name',
    'string address nullable',
    'bool finishing_enabled default:1',
    'bool is_active default:1',
], ['nobranch' => true]);

$add('units', 'Unit', 'Foundation', [
    'string code',
    'string name',
    'integer loom_count default:0',
    'bool is_active default:1',
]);

$add('departments', 'Department', 'Foundation', [
    'string code',
    'string name',
    'foreignId unit_id units nullable',
]);

$add('sections', 'Section', 'Foundation', [
    'foreignId department_id departments nullable',
    'string code',
    'string name',
]);

$add('cost_centres', 'CostCentre', 'Foundation', [
    'string code unique',
    'string name',
    'string type default:department',
    'foreignId department_id departments nullable',
]);

$add('shifts', 'Shift', 'Foundation', [
    'string code',
    'string name',
    'time starts_at',
    'time ends_at',
    'integer break_minutes default:0',
    'bool is_night default:0',
]);

$add('holidays', 'Holiday', 'Foundation', [
    'date holiday_date',
    'string name',
    'string name_bn nullable',
    'bool paid default:1',
]);

$add('fiscal_years', 'FiscalYear', 'Foundation', [
    'string name',
    'date starts_on',
    'date ends_on',
    'bool is_closed default:0',
]);

$add('fiscal_periods', 'FiscalPeriod', 'Foundation', [
    'foreignId fiscal_year_id fiscal_years',
    'string name',
    'date starts_on',
    'date ends_on',
    'bool is_locked default:0',
]);

$add('number_series', 'NumberSeries', 'Foundation', [
    'string document_type',
    'string prefix default:DOC',
    'integer next_number default:1',
    'integer padding default:5',
    'string reset_rule default:yearly',
    'integer year default:2026',
]);

$add('settings', 'Setting', 'Foundation', [
    'string key',
    'string group default:general',
    'text value nullable',
]);

$add('exchange_rates', 'ExchangeRate', 'Foundation', [
    'foreignId currency_id currencies',
    'date rate_date',
    $rate('rate'),
    'string source default:manual',
]);

$add('roles', 'Role', 'Access Control', [
    'string name',
    'string slug unique',
    'string panel default:admin',
    'bool is_system default:1',
    'bool requires_two_factor default:0',
], ['nobranch' => true]);

$add('permissions', 'Permission', 'Access Control', [
    'string name unique',
    'string group default:general',
], ['nobranch' => true]);

$tables[] = [
    'table' => 'role_user',
    'pivot' => true,
    'cols' => [
        'foreignId role_id roles',
        'foreignId user_id users',
        'foreignId branch_id branches nullable',
        'foreignId unit_id units nullable',
    ],
];

$tables[] = [
    'table' => 'permission_role',
    'pivot' => true,
    'cols' => [
        'foreignId permission_id permissions',
        'foreignId role_id roles',
    ],
];

$add('field_permissions', 'FieldPermission', 'Access Control', [
    'foreignId role_id roles',
    'string resource',
    'string field',
    'bool can_view default:0',
    'bool can_edit default:0',
]);

$add('approval_limits', 'ApprovalLimit', 'Access Control', [
    'foreignId role_id roles',
    'string document_type',
    $money('max_amount'),
]);

$add('approval_flows', 'ApprovalFlow', 'Foundation', [
    'string document_type',
    'string name',
    'bool is_active default:1',
]);

$add('approval_steps', 'ApprovalStep', 'Foundation', [
    'foreignId approval_flow_id approval_flows',
    'integer step_no default:1',
    'string role_slug',
    $money('min_amount'),
]);

$add('approval_requests', 'ApprovalRequest', 'Foundation', [
    ...$doc,
    'string document_type',
    'unsignedInteger document_id',
    'foreignId approval_flow_id approval_flows nullable',
    'integer current_step default:1',
    $money('amount'),
]);

$add('approval_actions', 'ApprovalAction', 'Foundation', [
    'foreignId approval_request_id approval_requests',
    'foreignId user_id users nullable',
    'string action default:submitted',
    'text comment nullable',
]);

$add('attachments', 'Attachment', 'Foundation', [
    'string attachable_type',
    'unsignedInteger attachable_id index',
    'string disk default:public',
    'string path',
    'string name',
    'string mime nullable',
    'unsignedInteger size default:0',
]);

$add('comments', 'Comment', 'Foundation', [
    'string commentable_type',
    'unsignedInteger commentable_id index',
    'foreignId user_id users nullable',
    'text body',
]);

$add('warehouses', 'Warehouse', 'Master Data', [
    'string code',
    'string name',
    'string store_type default:yarn',
    'foreignId unit_id units nullable',
]);

$add('bins', 'Bin', 'Master Data', [
    'foreignId warehouse_id warehouses',
    'string code',
    'string name',
]);

$add('unit_of_measures', 'UnitOfMeasure', 'Master Data', [
    'string code unique',
    'string name',
    'string dimension default:length',
], ['nobranch' => true, 'label' => 'Units of measure']);

$add('uom_conversions', 'UomConversion', 'Master Data', [
    'foreignId from_uom_id unit_of_measures',
    'foreignId to_uom_id unit_of_measures',
    'decimal factor 18,6 default:1',
    'foreignId article_id fabric_articles nullable',
], ['label' => 'UoM conversions']);

$add('parties', 'Party', 'Master Data', [
    'string code unique',
    'string name',
    'string type default:buyer',
    'string country default:BD',
    'string currency_code default:BDT',
    $money('credit_limit'),
    'integer payment_days default:30',
    'string email nullable',
    'string phone nullable',
    'string tax_id nullable',
    'text address nullable',
    'bool is_active default:1',
]);

$add('party_contacts', 'PartyContact', 'Master Data', [
    'foreignId party_id parties',
    'string name',
    'string email nullable',
    'string phone nullable',
    'string role_title nullable',
]);

$add('hs_codes', 'HsCode', 'Master Data', [
    'string code unique',
    'string description',
    'decimal duty_pct 8,3 default:0',
], ['nobranch' => true, 'label' => 'HS codes']);

$add('tax_rules', 'TaxRule', 'Master Data', [
    'string code unique',
    'string name',
    'string country default:BD',
    'string kind default:vat',
    'decimal rate_pct 8,4 default:0',
    'string form_code nullable',
], ['nobranch' => true]);

$add('payment_terms', 'PaymentTerm', 'Master Data', [
    'string code unique',
    'string name',
    'integer days default:0',
], ['nobranch' => true]);

$add('incoterms', 'Incoterm', 'Master Data', [
    'string code unique',
    'string name',
], ['nobranch' => true]);

$add('ports', 'Port', 'Master Data', [
    'string code unique',
    'string name',
    'string country default:BD',
], ['nobranch' => true]);

$add('yarns', 'Yarn', 'Master Data', [
    'string code unique',
    'string name',
    'decimal count_value 10,3 default:40',
    'string count_system default:Ne',
    'string yarn_type default:combed',
    'decimal cotton_pct 6,2 default:100',
    'decimal poly_pct 6,2 default:0',
    'decimal viscose_pct 6,2 default:0',
    'string twist_direction default:Z',
    'integer ply default:1',
    'string origin nullable',
    'string mill_brand nullable',
    'string colour default:raw-white',
    'decimal cone_weight_kg 10,3 default:2.083',
    'bool is_filament default:0',
    $rate('standard_cost'),
    'decimal reorder_kg 18,3 default:0',
]);

$add('yarn_lots', 'YarnLot', 'Master Data', [
    'foreignId yarn_id yarns nullable',
    'foreignId supplier_id parties nullable',
    'string lot_no',
    $qty('qty_kg'),
    $rate('unit_cost'),
    'string status default:available',
    'date received_on nullable',
]);

$add('fabric_articles', 'FabricArticle', 'Master Data', [
    'string code unique',
    'string name',
    'string slug nullable',
    'foreignId warp_yarn_id yarns nullable',
    'foreignId weft_yarn_id yarns nullable',
    'decimal epi 8,2 default:0',
    'decimal ppi 8,2 default:0',
    'string weave default:plain',
    'decimal grey_width_cm 8,2 default:0',
    'decimal finished_width_cm 8,2 default:0',
    'decimal grey_gsm 8,2 default:0',
    'decimal finished_gsm 8,2 default:0',
    'decimal warp_shrinkage_pct 6,2 default:0',
    'decimal weft_shrinkage_pct 6,2 default:0',
    'string composition nullable',
    'string finish_type nullable',
    'string end_use nullable',
    'decimal reed_count 8,2 default:0',
    'decimal reed_space_inch 8,2 default:0',
    'integer ends_per_dent default:2',
    'integer selvedge_ends default:0',
    'string selvedge_type nullable',
    'decimal crimp_warp_pct 6,2 default:8',
    'decimal crimp_weft_pct 6,2 default:6',
    'json design_grid nullable',
    'integer total_ends default:0',
    'decimal warp_kg_per_100m 18,4 default:0',
    'decimal weft_kg_per_100m 18,4 default:0',
    'decimal calculated_gsm 8,2 default:0',
    'decimal expected_efficiency 6,2 default:85',
    'decimal metres_per_loom_shift 18,3 default:0',
    'bool is_public default:0',
    'text public_summary nullable',
    'string image_path nullable',
], ['slug' => 'name', 'label' => 'Fabric articles']);

$add('chemicals', 'Chemical', 'Master Data', [
    'string code unique',
    'string name',
    'string kind default:size',
    'string uom default:kg',
    $rate('standard_cost'),
    'integer shelf_life_days default:180',
    'decimal reorder_qty 18,3 default:0',
]);

$add('size_recipes', 'SizeRecipe', 'Master Data', [
    'string code unique',
    'string name',
    'foreignId article_id fabric_articles nullable',
    'decimal target_pickup_pct 6,2 default:10',
    'text notes nullable',
]);

$add('size_recipe_items', 'SizeRecipeItem', 'Master Data', [
    'foreignId size_recipe_id size_recipes nullable',
    'foreignId chemical_id chemicals nullable',
    'decimal qty_per_kg 18,4 default:0',
]);

$add('spares', 'Spare', 'Master Data', [
    'string code unique',
    'string name',
    'string criticality default:B',
    'decimal min_qty 18,3 default:0',
    'decimal max_qty 18,3 default:0',
    'integer lead_time_days default:15',
    $rate('standard_cost'),
    'foreignId machine_id machines nullable',
]);

$add('packing_materials', 'PackingMaterial', 'Master Data', [
    'string code unique',
    'string name',
    'string kind default:carton',
    $rate('standard_cost'),
]);

$add('machines', 'Machine', 'Master Data', [
    'string code unique',
    'string name',
    'string machine_type default:loom',
    'string make nullable',
    'string model_name nullable',
    'string shed_mechanism nullable',
    'integer rpm default:550',
    'decimal reed_width_cm 8,2 default:190',
    'integer selectors default:4',
    'integer year_installed nullable',
    'decimal motor_kw 8,2 default:0',
    'string location nullable',
    'foreignId unit_id units nullable',
    'foreignId section_id sections nullable',
    'string status default:running',
    'bool is_public default:0',
    'integer running_hours default:0',
]);

$add('defects', 'Defect', 'Master Data', [
    'string code unique',
    'string name',
    'string name_bn nullable',
    'string system default:both',
    'string cause_category default:weaving',
    'text corrective_action nullable',
], ['nobranch' => true]);

$add('employees', 'Employee', 'HR & Payroll', [
    'string code unique',
    'string name',
    'string nid nullable',
    'string employment_type default:worker',
    'foreignId department_id departments nullable',
    'string designation nullable',
    'string grade nullable',
    'date join_date nullable',
    'integer skill_level default:1',
    'foreignId user_id users nullable',
    $money('basic_salary'),
    'string bank_account nullable',
    'string payment_channel default:bank',
    'bool is_active default:1',
]);

$add('leads', 'Lead', 'Marketing & Sales', [
    ...$doc,
    'string company_name',
    'string contact_name nullable',
    'string email nullable',
    'string phone nullable',
    'string source default:website',
    'string country default:BD',
]);

$add('inquiries', 'Inquiry', 'Marketing & Sales', [
    ...$doc,
    'foreignId lead_id leads nullable',
    'foreignId buyer_id parties nullable',
    'string subject',
    'text requirement nullable',
    'date needed_by nullable',
]);

$add('visits', 'Visit', 'Marketing & Sales', [
    'foreignId buyer_id parties nullable',
    'date visited_on',
    'string location nullable',
    'text notes nullable',
]);

$add('meetings', 'Meeting', 'Marketing & Sales', [
    'foreignId buyer_id parties nullable',
    'datetime met_at nullable',
    'string subject',
    'text minutes nullable',
]);

$add('follow_ups', 'FollowUp', 'Marketing & Sales', [
    'foreignId inquiry_id inquiries nullable',
    'date due_on',
    'string channel default:phone',
    'text notes nullable',
    'bool is_done default:0',
]);

$add('sample_requests', 'SampleRequest', 'Marketing & Sales', [
    ...$doc,
    'foreignId buyer_id parties nullable',
    'foreignId inquiry_id inquiries nullable',
    'foreignId article_id fabric_articles nullable',
    'string sample_type default:handloom',
    'string shade nullable',
    $qty('quantity_m'),
    'date due_on nullable',
]);

$add('samples', 'Sample', 'Marketing & Sales', [
    ...$doc,
    'foreignId sample_request_id sample_requests nullable',
    'foreignId article_id fabric_articles nullable',
    'string shade nullable',
    $money('development_cost'),
    'text buyer_comment nullable',
]);

$add('cost_sheets', 'CostSheet', 'Marketing & Sales', [
    ...$doc,
    'foreignId article_id fabric_articles nullable',
    'foreignId buyer_id parties nullable',
    'string currency_code default:BDT',
    $rate('yarn_cost_per_m'),
    $rate('sizing_cost_per_m'),
    $rate('weaving_cost_per_m'),
    $rate('process_cost_per_m'),
    $rate('overhead_per_m'),
    $rate('finance_cost_per_m'),
    $rate('commission_per_m'),
    'decimal target_margin_pct 6,2 default:12',
    $rate('quoted_rate'),
    'date valid_until nullable',
    'json sensitivity nullable',
]);

$add('cost_sheet_lines', 'CostSheetLine', 'Marketing & Sales', [
    'foreignId cost_sheet_id cost_sheets nullable',
    'string component',
    $rate('rate'),
    $qty('quantity'),
    $money('amount'),
]);

$add('quotations', 'Quotation', 'Marketing & Sales', [
    ...$doc,
    'foreignId buyer_id parties nullable',
    'foreignId cost_sheet_id cost_sheets nullable',
    'foreignId currency_id currencies nullable',
    'date quote_date',
    'date valid_until nullable',
    $money('total'),
]);

$add('quotation_lines', 'QuotationLine', 'Marketing & Sales', [
    'foreignId quotation_id quotations nullable',
    'foreignId article_id fabric_articles nullable',
    'string shade nullable',
    $qty('quantity'),
    'string uom default:m',
    $rate('rate'),
    $money('amount'),
    'date delivery_date nullable',
]);

$add('proforma_invoices', 'ProformaInvoice', 'Marketing & Sales', [
    ...$doc,
    'foreignId quotation_id quotations nullable',
    'foreignId buyer_id parties nullable',
    'foreignId currency_id currencies nullable',
    'foreignId payment_term_id payment_terms nullable',
    'foreignId incoterm_id incoterms nullable',
    'date pi_date',
    $money('total'),
], ['label' => 'Proforma invoices']);

$add('proforma_lines', 'ProformaLine', 'Marketing & Sales', [
    'foreignId proforma_invoice_id proforma_invoices nullable',
    'foreignId article_id fabric_articles nullable',
    $qty('quantity'),
    'string uom default:m',
    $rate('rate'),
    $money('amount'),
]);

$add('sales_contracts', 'SalesContract', 'Marketing & Sales', [
    ...$doc,
    'foreignId buyer_id parties nullable',
    'foreignId proforma_invoice_id proforma_invoices nullable',
    'string contract_no nullable',
    'date contract_date nullable',
    $money('amount'),
    'string currency_code default:USD',
]);

$add('letters_of_credit', 'LetterOfCredit', 'Marketing & Sales', [
    ...$doc,
    'string lc_type default:export',
    'foreignId buyer_id parties nullable',
    'foreignId bank_id parties nullable',
    'foreignId sales_contract_id sales_contracts nullable',
    'string lc_number nullable',
    $money('amount'),
    $money('utilised'),
    'string currency_code default:USD',
    'date expiry_date nullable',
    'date shipment_date nullable',
    'decimal btb_limit_pct 6,2 default:70',
], ['label' => 'Letters of credit']);

$add('sales_orders', 'SalesOrder', 'Marketing & Sales', [
    ...$doc,
    'foreignId buyer_id parties nullable',
    'foreignId quotation_id quotations nullable',
    'foreignId sales_contract_id sales_contracts nullable',
    'foreignId lc_id letters_of_credit nullable',
    'foreignId currency_id currencies nullable',
    'date order_date',
    'date delivery_date nullable',
    'decimal tolerance_pct 6,2 default:5',
    $money('total'),
    'decimal margin_pct 6,2 default:0',
    'json feasibility nullable',
]);

$add('sales_order_lines', 'SalesOrderLine', 'Marketing & Sales', [
    'foreignId sales_order_id sales_orders nullable',
    'foreignId article_id fabric_articles nullable',
    'string shade nullable',
    'decimal width_cm 8,2 default:0',
    $qty('quantity'),
    'string uom default:m',
    $rate('rate'),
    $money('amount'),
    'date delivery_date nullable',
    'decimal tolerance_pct 6,2 default:5',
    $qty('produced_qty'),
    $qty('dispatched_qty'),
]);

$add('price_lists', 'PriceList', 'Marketing & Sales', [
    'string name',
    'foreignId buyer_id parties nullable',
    'foreignId currency_id currencies nullable',
    'date valid_from nullable',
    'date valid_to nullable',
    'bool is_active default:1',
]);

$add('price_list_lines', 'PriceListLine', 'Marketing & Sales', [
    'foreignId price_list_id price_lists nullable',
    'foreignId article_id fabric_articles nullable',
    $rate('rate'),
    'decimal discount_pct 6,2 default:0',
]);

$add('purchase_requisitions', 'PurchaseRequisition', 'Procurement', [
    ...$doc,
    'foreignId department_id departments nullable',
    'string source default:manual',
    'date needed_by nullable',
    $money('estimated_total'),
]);

$add('purchase_requisition_lines', 'PurchaseRequisitionLine', 'Procurement', [
    'foreignId purchase_requisition_id purchase_requisitions nullable',
    'string item_type default:yarn',
    'unsignedInteger item_id nullable',
    'string description',
    $qty('quantity'),
    'string uom default:kg',
    $rate('estimated_rate'),
]);

$add('request_for_quotations', 'RequestForQuotation', 'Procurement', [
    ...$doc,
    'foreignId purchase_requisition_id purchase_requisitions nullable',
    'date due_on nullable',
], ['label' => 'RFQs']);

$add('rfq_lines', 'RfqLine', 'Procurement', [
    'foreignId rfq_id request_for_quotations nullable',
    'string description',
    $qty('quantity'),
    'string uom default:kg',
]);

$add('rfq_quotes', 'RfqQuote', 'Procurement', [
    'foreignId rfq_id request_for_quotations nullable',
    'foreignId supplier_id parties nullable',
    $rate('rate'),
    'integer delivery_days default:0',
    'decimal quality_score 6,2 default:0',
    'integer rank default:0',
    'bool is_selected default:0',
]);

$add('purchase_orders', 'PurchaseOrder', 'Procurement', [
    ...$doc,
    'foreignId supplier_id parties nullable',
    'foreignId purchase_requisition_id purchase_requisitions nullable',
    'foreignId currency_id currencies nullable',
    'foreignId payment_term_id payment_terms nullable',
    'foreignId incoterm_id incoterms nullable',
    'foreignId lc_id letters_of_credit nullable',
    'bool is_import default:0',
    'date order_date',
    'date delivery_date nullable',
    $money('total'),
]);

$add('purchase_order_lines', 'PurchaseOrderLine', 'Procurement', [
    'foreignId purchase_order_id purchase_orders nullable',
    'string item_type default:yarn',
    'unsignedInteger item_id nullable',
    'foreignId yarn_id yarns nullable',
    'string description',
    $qty('quantity'),
    $qty('received_qty'),
    'string uom default:kg',
    $rate('rate'),
    $money('amount'),
]);

$add('shipments', 'Shipment', 'Procurement', [
    ...$doc,
    'foreignId purchase_order_id purchase_orders nullable',
    'string bl_number nullable',
    'string container_no nullable',
    'date etd nullable',
    'date eta nullable',
    'foreignId port_id ports nullable',
]);

$add('bills_of_entry', 'BillOfEntry', 'Procurement', [
    ...$doc,
    'foreignId shipment_id shipments nullable',
    'string be_number nullable',
    'date be_date nullable',
    $money('assessable_value'),
    $money('duty'),
    $money('vat'),
    $money('other_charges'),
], ['label' => 'Bills of entry']);

$add('landed_costs', 'LandedCost', 'Procurement', [
    'foreignId bill_of_entry_id bills_of_entry nullable',
    'foreignId purchase_order_id purchase_orders nullable',
    'foreignId yarn_lot_id yarn_lots nullable',
    $money('invoice_amount'),
    $money('freight'),
    $money('insurance'),
    $money('duty'),
    $money('port_charges'),
    $money('cf_charges'),
    $qty('quantity'),
    $rate('unit_cost'),
]);

$add('supplier_claims', 'SupplierClaim', 'Procurement', [
    ...$doc,
    'foreignId supplier_id parties nullable',
    'foreignId yarn_lot_id yarn_lots nullable',
    'string reason',
    $qty('claimed_qty'),
    $money('amount'),
    $money('recovered'),
]);

$add('supplier_scorecards', 'SupplierScorecard', 'Procurement', [
    'foreignId supplier_id parties nullable',
    'date period_start',
    'date period_end',
    'decimal quality_score 6,2 default:0',
    'decimal delivery_score 6,2 default:0',
    'decimal price_score 6,2 default:0',
    'decimal claim_score 6,2 default:0',
    'decimal total_score 6,2 default:0',
]);

$add('goods_receipts', 'GoodsReceipt', 'Inventory', [
    ...$doc,
    'foreignId purchase_order_id purchase_orders nullable',
    'foreignId warehouse_id warehouses nullable',
    'datetime received_at nullable',
    'string qc_status default:quarantine',
], ['label' => 'Goods receipts']);

$add('goods_receipt_lines', 'GoodsReceiptLine', 'Inventory', [
    'foreignId goods_receipt_id goods_receipts nullable',
    'foreignId purchase_order_line_id purchase_order_lines nullable',
    'string item_type default:yarn',
    'unsignedInteger item_id nullable',
    'string lot_no nullable',
    $qty('quantity'),
    $qty('accepted_qty'),
    $qty('rejected_qty'),
    'string uom default:kg',
    $rate('unit_cost'),
    'string qc_status default:quarantine',
]);

$add('stock_lots', 'StockLot', 'Inventory', [
    'string item_type',
    'unsignedInteger item_id',
    'string lot_no',
    'foreignId warehouse_id warehouses nullable',
    'foreignId supplier_id parties nullable',
    'foreignId yarn_lot_id yarn_lots nullable',
    $qty('qty'),
    $qty('reserved_qty'),
    'string uom default:kg',
    $rate('unit_cost'),
    'string status default:quarantine',
    'date expiry_date nullable',
    'string hold_reason nullable',
]);

$add('stock_moves', 'StockMove', 'Inventory', [
    'foreignId stock_lot_id stock_lots nullable',
    'foreignId warehouse_id warehouses nullable',
    'foreignId bin_id bins nullable',
    'decimal qty 18,3 default:0',
    'string uom default:kg',
    $rate('unit_cost'),
    'string move_type default:grn',
    'string reference_type nullable',
    'unsignedInteger reference_id nullable',
    'foreignId job_card_id job_cards nullable',
    'bool mix_approved default:0',
    'string narration nullable',
]);

$add('stock_balances', 'StockBalance', 'Inventory', [
    'foreignId warehouse_id warehouses nullable',
    'foreignId stock_lot_id stock_lots nullable',
    $qty('qty'),
    $money('value'),
]);

$add('stock_counts', 'StockCount', 'Inventory', [
    ...$doc,
    'foreignId warehouse_id warehouses nullable',
    'date count_date',
    'string count_type default:cyclic',
]);

$add('stock_count_lines', 'StockCountLine', 'Inventory', [
    'foreignId stock_count_id stock_counts nullable',
    'foreignId stock_lot_id stock_lots nullable',
    $qty('book_qty'),
    $qty('physical_qty'),
    $qty('variance_qty'),
]);

$add('stock_transfers', 'StockTransfer', 'Inventory', [
    ...$doc,
    'foreignId from_warehouse_id warehouses nullable',
    'foreignId to_warehouse_id warehouses nullable',
    'string transit_status default:draft',
]);

$add('stock_transfer_lines', 'StockTransferLine', 'Inventory', [
    'foreignId stock_transfer_id stock_transfers nullable',
    'foreignId stock_lot_id stock_lots nullable',
    $qty('quantity'),
]);

$add('bill_of_materials', 'BillOfMaterial', 'Planning', [
    'foreignId article_id fabric_articles nullable',
    'decimal warp_kg_per_100m 18,4 default:0',
    'decimal weft_kg_per_100m 18,4 default:0',
    'decimal size_addon_pct 6,2 default:10',
    'decimal waste_warping_pct 6,2 default:1',
    'decimal waste_sizing_pct 6,2 default:0.5',
    'decimal waste_drawing_pct 6,2 default:0.2',
    'decimal waste_weaving_pct 6,2 default:2',
    'decimal waste_inspection_pct 6,2 default:1',
    'bool is_active default:1',
], ['label' => 'Bills of material']);

$add('bom_lines', 'BomLine', 'Planning', [
    'foreignId bom_id bill_of_materials nullable',
    'string stage default:weaving',
    'string item_type default:yarn',
    'unsignedInteger item_id nullable',
    'decimal qty_per_100m 18,4 default:0',
    'string uom default:kg',
]);

$add('production_plans', 'ProductionPlan', 'Planning', [
    ...$doc,
    'foreignId sales_order_id sales_orders nullable',
    'date start_date nullable',
    'date end_date nullable',
    'text notes nullable',
]);

$add('yarn_requirements', 'YarnRequirement', 'Planning', [
    'foreignId production_plan_id production_plans nullable',
    'foreignId yarn_id yarns nullable',
    'string direction default:warp',
    $qty('required_kg'),
    $qty('available_kg'),
    $qty('shortage_kg'),
]);

$add('beam_plans', 'BeamPlan', 'Planning', [
    'foreignId production_plan_id production_plans nullable',
    'foreignId article_id fabric_articles nullable',
    'decimal warp_length_m 18,3 default:0',
    'integer ends default:0',
    'integer beam_count default:1',
    'decimal beam_length_m 18,3 default:0',
    'integer cones default:0',
]);

$add('loom_allocations', 'LoomAllocation', 'Planning', [
    'foreignId production_plan_id production_plans nullable',
    'foreignId loom_id machines nullable',
    'foreignId article_id fabric_articles nullable',
    'date start_date nullable',
    'date end_date nullable',
    $qty('planned_metres'),
    'integer style_change_minutes default:0',
    'string status default:planned',
]);

$add('job_cards', 'JobCard', 'Planning', [
    ...$doc,
    'foreignId production_plan_id production_plans nullable',
    'foreignId sales_order_line_id sales_order_lines nullable',
    'foreignId article_id fabric_articles nullable',
    'string stage default:warping',
    $qty('qty_m'),
    'string barcode nullable',
]);

$add('warping_jobs', 'WarpingJob', 'Production', [
    ...$doc,
    'foreignId job_card_id job_cards nullable',
    'foreignId article_id fabric_articles nullable',
    'foreignId yarn_id yarns nullable',
    'foreignId yarn_lot_id yarn_lots nullable',
    'foreignId machine_id machines nullable',
    'foreignId operator_id employees nullable',
    'foreignId shift_id shifts nullable',
    'integer ends default:0',
    'decimal beam_length_m 18,3 default:0',
    'integer speed default:0',
    'integer stops default:0',
    'decimal breakage_per_million 10,2 default:0',
    $qty('yarn_issued_kg'),
    $qty('yarn_consumed_kg'),
    $qty('soft_waste_kg'),
    $qty('hard_waste_kg'),
]);

$add('warping_creel_positions', 'WarpingCreelPosition', 'Production', [
    'foreignId warping_job_id warping_jobs nullable',
    'integer position_no default:1',
    'foreignId yarn_lot_id yarn_lots nullable',
    'string cone_barcode nullable',
]);

$add('section_beams', 'SectionBeam', 'Production', [
    'string number unique',
    'foreignId warping_job_id warping_jobs nullable',
    'foreignId machine_id machines nullable',
    'foreignId operator_id employees nullable',
    'integer ends default:0',
    'decimal length_m 18,3 default:0',
    'decimal gross_kg 18,3 default:0',
    'decimal net_kg 18,3 default:0',
    'string status default:in_stock',
]);

$add('sizing_batches', 'SizingBatch', 'Production', [
    ...$doc,
    'foreignId size_recipe_id size_recipes nullable',
    'foreignId machine_id machines nullable',
    'datetime cooked_at nullable',
    'decimal viscosity 8,2 default:0',
    'decimal concentration 8,2 default:0',
    'decimal pickup_target 6,2 default:10',
    'decimal pickup_actual 6,2 default:0',
    'decimal moisture 6,2 default:0',
    'decimal stretch_pct 6,2 default:0',
    'integer speed default:0',
    'decimal steam_pressure 8,2 default:0',
    $qty('chemical_kg'),
    $money('cost'),
]);

$add('sizing_logs', 'SizingLog', 'Production', [
    'foreignId sizing_batch_id sizing_batches nullable',
    'foreignId section_beam_id section_beams nullable',
    'string beam_no nullable',
    'decimal warp_length_m 18,3 default:0',
    'integer speed default:0',
    'decimal size_box_temp 6,2 default:0',
    'decimal squeeze_pressure 8,2 default:0',
]);

$add('weaver_beams', 'WeaverBeam', 'Production', [
    'string number unique',
    'foreignId sizing_batch_id sizing_batches nullable',
    'foreignId article_id fabric_articles nullable',
    'decimal length_m 18,3 default:0',
    'decimal leftover_m 18,3 default:0',
    'integer ends default:0',
    'decimal size_addon_pct 6,2 default:0',
    'decimal gross_kg 18,3 default:0',
    'decimal net_kg 18,3 default:0',
    'string grade default:A',
    'string position default:store',
]);

$add('drawing_jobs', 'DrawingJob', 'Production', [
    ...$doc,
    'foreignId weaver_beam_id weaver_beams nullable',
    'foreignId article_id fabric_articles nullable',
    'foreignId reed_id reeds nullable',
    'foreignId heald_frame_id heald_frames nullable',
    'foreignId operator_id employees nullable',
    'string method default:fresh',
    'integer wrong_draws default:0',
    'integer double_ends default:0',
]);

$add('reeds', 'Reed', 'Production', [
    'string code unique',
    'decimal reed_count 8,2 default:0',
    'decimal reed_space_cm 8,2 default:0',
    'string status default:in_stock',
    'integer wear_score default:0',
    'foreignId loom_id machines nullable',
]);

$add('heald_frames', 'HealdFrame', 'Production', [
    'string code unique',
    'integer frame_no default:1',
    'integer wire_count default:0',
    'string status default:in_stock',
    'foreignId loom_id machines nullable',
]);

$add('loom_setups', 'LoomSetup', 'Production', [
    'foreignId loom_id machines nullable',
    'foreignId article_id fabric_articles nullable',
    'foreignId weaver_beam_id weaver_beams nullable',
    'foreignId reed_id reeds nullable',
    'integer speed default:0',
    'text settings nullable',
    'integer setup_minutes default:0',
    'foreignId operator_id employees nullable',
    'datetime started_at nullable',
    'datetime finished_at nullable',
]);

$add('loom_productions', 'LoomProduction', 'Production', [
    'foreignId loom_id machines nullable',
    'foreignId shift_id shifts nullable',
    'foreignId operator_id employees nullable',
    'foreignId article_id fabric_articles nullable',
    'foreignId job_card_id job_cards nullable',
    'foreignId weaver_beam_id weaver_beams nullable',
    'date production_date',
    'integer picks default:0',
    'integer rpm default:0',
    'integer minutes default:480',
    'decimal efficiency 6,2 default:0',
    'decimal metres 18,3 default:0',
    'integer warp_breaks default:0',
    'integer weft_breaks default:0',
    'integer stoppage_minutes default:0',
    'string source default:kiosk',
]);

$add('loom_stoppages', 'LoomStoppage', 'Production', [
    'foreignId loom_id machines nullable',
    'foreignId shift_id shifts nullable',
    'foreignId operator_id employees nullable',
    'string reason_code default:unspecified',
    'string reason_bn nullable',
    'datetime started_at nullable',
    'datetime ended_at nullable',
    'integer minutes default:0',
    'string source default:kiosk',
]);

$add('fabric_rolls', 'FabricRoll', 'Production', [
    'string number unique',
    'foreignId article_id fabric_articles nullable',
    'foreignId loom_id machines nullable',
    'foreignId operator_id employees nullable',
    'foreignId shift_id shifts nullable',
    'foreignId weaver_beam_id weaver_beams nullable',
    'foreignId sizing_batch_id sizing_batches nullable',
    'foreignId warp_lot_id yarn_lots nullable',
    'foreignId weft_lot_id yarn_lots nullable',
    'foreignId job_card_id job_cards nullable',
    'decimal length_m 18,3 default:0',
    'decimal weight_kg 18,3 default:0',
    'decimal grey_width_cm 8,2 default:0',
    'decimal gsm 8,2 default:0',
    'string grade nullable',
    'decimal points 10,2 default:0',
    'string inspection_system default:4-point',
    'string status default:grey',
    'datetime doffed_at nullable',
    'string barcode nullable',
]);

$add('roll_defects', 'RollDefect', 'Production', [
    'foreignId fabric_roll_id fabric_rolls nullable',
    'foreignId defect_id defects nullable',
    'decimal position_m 18,3 default:0',
    'decimal length_inch 8,2 default:1',
    'integer points default:1',
    'string photo_path nullable',
    'foreignId inspector_id employees nullable',
    'bool human_confirmed default:1',
]);

$add('finishing_batches', 'FinishingBatch', 'Production', [
    ...$doc,
    'foreignId article_id fabric_articles nullable',
    'foreignId subcontractor_id parties nullable',
    'string process_route default:jobwork',
    'string shade nullable',
    $qty('grey_m'),
    $qty('finished_m'),
    'decimal process_loss_pct 6,2 default:0',
    $rate('rate_per_m'),
    $money('cost'),
    'bool is_reprocess default:0',
]);

$add('finishing_stages', 'FinishingStage', 'Production', [
    'foreignId finishing_batch_id finishing_batches nullable',
    'string stage default:singeing',
    'json parameters nullable',
    'string result default:pending',
    'datetime started_at nullable',
    'datetime finished_at nullable',
]);

$add('jobwork_challans', 'JobworkChallan', 'Production', [
    ...$doc,
    'foreignId subcontractor_id parties nullable',
    'foreignId finishing_batch_id finishing_batches nullable',
    'string direction default:out',
    $qty('metres'),
    'date challan_date nullable',
]);

$add('jobwork_challan_lines', 'JobworkChallanLine', 'Production', [
    'foreignId jobwork_challan_id jobwork_challans nullable',
    'foreignId fabric_roll_id fabric_rolls nullable',
    $qty('metres'),
]);

$add('packing_lists', 'PackingList', 'Production', [
    ...$doc,
    'foreignId sales_order_id sales_orders nullable',
    'integer cartons default:0',
    'decimal gross_kg 18,3 default:0',
    'decimal net_kg 18,3 default:0',
    $qty('total_metres'),
]);

$add('packing_list_lines', 'PackingListLine', 'Production', [
    'foreignId packing_list_id packing_lists nullable',
    'foreignId fabric_roll_id fabric_rolls nullable',
    'string carton_no nullable',
    $qty('metres'),
    'decimal net_kg 18,3 default:0',
    'decimal gross_kg 18,3 default:0',
]);

$add('test_packages', 'TestPackage', 'Quality', [
    'string code unique',
    'string name',
    'foreignId buyer_id parties nullable',
    'string standard default:ISO',
]);

$add('test_limits', 'TestLimit', 'Quality', [
    'foreignId test_package_id test_packages nullable',
    'string parameter',
    'string unit nullable',
    'decimal min_value 18,4 nullable',
    'decimal max_value 18,4 nullable',
]);

$add('instruments', 'Instrument', 'Quality', [
    'string code unique',
    'string name',
    'date calibrated_on nullable',
    'date calibration_due nullable',
    'string certificate_no nullable',
]);

$add('lab_tests', 'LabTest', 'Quality', [
    ...$doc,
    'string sample_type default:yarn',
    'string related_type nullable',
    'unsignedInteger related_id nullable',
    'foreignId test_package_id test_packages nullable',
    'string result default:pending',
    'datetime tested_at nullable',
]);

$add('lab_test_results', 'LabTestResult', 'Quality', [
    'foreignId lab_test_id lab_tests nullable',
    'string parameter',
    'string value nullable',
    'string unit nullable',
    'decimal min_limit 18,4 nullable',
    'decimal max_limit 18,4 nullable',
    'bool passed default:0',
]);

$add('buyer_claims', 'BuyerClaim', 'Quality', [
    ...$doc,
    'foreignId buyer_id parties nullable',
    'foreignId fabric_roll_id fabric_rolls nullable',
    'string reason',
    $qty('claimed_m'),
    $money('amount'),
    'text root_cause nullable',
    'foreignId issue_id issues nullable',
]);

$add('assets', 'Asset', 'Maintenance', [
    'string code unique',
    'string name',
    'foreignId machine_id machines nullable',
    'string category default:loom',
    'date commissioned_on nullable',
    'date warranty_until nullable',
    'text manual_ref nullable',
]);

$add('pm_schedules', 'PmSchedule', 'Maintenance', [
    'foreignId asset_id assets nullable',
    'foreignId machine_id machines nullable',
    'string frequency default:weekly',
    'integer every_hours default:0',
    'date next_due nullable',
    'bool is_active default:1',
], ['label' => 'PM schedules']);

$add('pm_tasks', 'PmTask', 'Maintenance', [
    'foreignId pm_schedule_id pm_schedules nullable',
    'string task',
    'bool is_done default:0',
    'date done_on nullable',
]);

$add('work_orders', 'WorkOrder', 'Maintenance', [
    ...$doc,
    'foreignId asset_id assets nullable',
    'foreignId machine_id machines nullable',
    'foreignId loom_id machines nullable',
    'string work_type default:breakdown',
    'foreignId mechanic_id employees nullable',
    'datetime started_at nullable',
    'datetime ended_at nullable',
    'integer downtime_minutes default:0',
    'text root_cause nullable',
    $money('cost'),
]);

$add('work_order_spares', 'WorkOrderSpare', 'Maintenance', [
    'foreignId work_order_id work_orders nullable',
    'foreignId spare_id spares nullable',
    $qty('quantity'),
    $money('cost'),
]);

$add('utility_readings', 'UtilityReading', 'Maintenance', [
    'date reading_date',
    'string utility default:power',
    'foreignId section_id sections nullable',
    'decimal reading_value 18,3 default:0',
    'string uom default:kWh',
    $money('cost'),
    'decimal metres_produced 18,3 default:0',
    'decimal cost_per_metre 18,4 default:0',
]);

$add('etp_logs', 'EtpLog', 'Maintenance', [
    'datetime logged_at nullable',
    'decimal inlet_ph 6,2 default:0',
    'decimal outlet_ph 6,2 default:0',
    'decimal inlet_bod 8,2 default:0',
    'decimal outlet_bod 8,2 default:0',
    'decimal sludge_kg 18,3 default:0',
    'bool within_limit default:1',
], ['label' => 'ETP logs']);

$add('amc_contracts', 'AmcContract', 'Maintenance', [
    ...$doc,
    'foreignId supplier_id parties nullable',
    'string asset_scope nullable',
    'date starts_on nullable',
    'date ends_on nullable',
    $money('annual_value'),
], ['label' => 'AMC contracts']);

$add('dispatch_advices', 'DispatchAdvice', 'Dispatch & Gate', [
    ...$doc,
    'foreignId sales_order_id sales_orders nullable',
    'foreignId buyer_id parties nullable',
    'foreignId transporter_id parties nullable',
    'date dispatch_date nullable',
    'string vehicle_no nullable',
    $qty('metres'),
]);

$add('dispatch_lines', 'DispatchLine', 'Dispatch & Gate', [
    'foreignId dispatch_advice_id dispatch_advices nullable',
    'foreignId sales_order_line_id sales_order_lines nullable',
    'foreignId fabric_roll_id fabric_rolls nullable',
    $qty('metres'),
]);

$add('commercial_invoices', 'CommercialInvoice', 'Dispatch & Gate', [
    ...$doc,
    'foreignId sales_order_id sales_orders nullable',
    'foreignId dispatch_advice_id dispatch_advices nullable',
    'foreignId buyer_id parties nullable',
    'foreignId currency_id currencies nullable',
    'date invoice_date',
    $money('amount'),
    $money('vat'),
    $money('total'),
    'string mushak_form nullable',
    'bool is_export default:0',
]);

$add('commercial_invoice_lines', 'CommercialInvoiceLine', 'Dispatch & Gate', [
    'foreignId commercial_invoice_id commercial_invoices nullable',
    'foreignId article_id fabric_articles nullable',
    'string description nullable',
    $qty('quantity'),
    'string uom default:m',
    $rate('rate'),
    $money('amount'),
]);

$add('document_checks', 'DocumentCheck', 'Dispatch & Gate', [
    'foreignId lc_id letters_of_credit nullable',
    'foreignId commercial_invoice_id commercial_invoices nullable',
    'string document_name',
    'bool is_present default:0',
    'bool matches_lc default:0',
    'text discrepancy nullable',
]);

$add('gate_passes', 'GatePass', 'Dispatch & Gate', [
    ...$doc,
    'string direction default:out',
    'foreignId party_id parties nullable',
    'string vehicle_no nullable',
    'string driver nullable',
    'string purpose nullable',
    'string reference_type nullable',
    'unsignedInteger reference_id nullable',
    'decimal gross_weight 18,3 default:0',
    'decimal tare_weight 18,3 default:0',
    'string qr_token nullable',
    'bool returnable default:0',
]);

$add('gate_pass_lines', 'GatePassLine', 'Dispatch & Gate', [
    'foreignId gate_pass_id gate_passes nullable',
    'string description',
    $qty('quantity'),
    'string uom default:kg',
]);

$add('visitors', 'Visitor', 'Dispatch & Gate', [
    'string name',
    'string company nullable',
    'string purpose nullable',
    'string badge_no nullable',
    'datetime in_at nullable',
    'datetime out_at nullable',
    'string host nullable',
]);

$add('security_rounds', 'SecurityRound', 'Dispatch & Gate', [
    'datetime rounded_at nullable',
    'string area',
    'foreignId employee_id employees nullable',
    'bool ok default:1',
    'text notes nullable',
]);

$add('security_incidents', 'SecurityIncident', 'Dispatch & Gate', [
    ...$doc,
    'datetime occurred_at nullable',
    'string severity default:low',
    'text description',
    'string cctv_ref nullable',
]);

$add('accounts', 'Account', 'Accounts', [
    'string code unique',
    'string name',
    'string account_type default:asset',
    'foreignId parent_id accounts nullable',
    'bool is_postable default:1',
    'bool is_active default:1',
], ['nobranch' => true, 'label' => 'Chart of accounts']);

$add('journals', 'Journal', 'Accounts', [
    'string number unique',
    'date journal_date',
    'string source_type nullable',
    'unsignedInteger source_id nullable',
    'string purpose default:manual',
    'string narration nullable',
    'string status default:posted',
    'string currency_code default:BDT',
    $money('total_debit'),
    $money('total_credit'),
]);

$add('journal_lines', 'JournalLine', 'Accounts', [
    'foreignId journal_id journals nullable',
    'foreignId account_id accounts nullable',
    'foreignId cost_centre_id cost_centres nullable',
    $money('debit'),
    $money('credit'),
    'string narration nullable',
    'string currency_code default:BDT',
    'decimal fx_rate 18,6 default:1',
]);

$add('payments', 'Payment', 'Accounts', [
    ...$doc,
    'foreignId party_id parties nullable',
    'foreignId bank_account_id bank_accounts nullable',
    $money('amount'),
    'string currency_code default:BDT',
    'string method default:bank',
    'string instrument_no nullable',
    'date paid_on nullable',
    'foreignId journal_id journals nullable',
]);

$add('receipts', 'Receipt', 'Accounts', [
    ...$doc,
    'foreignId party_id parties nullable',
    'foreignId commercial_invoice_id commercial_invoices nullable',
    'foreignId bank_account_id bank_accounts nullable',
    $money('amount'),
    'string currency_code default:BDT',
    'string method default:bank',
    'date received_on nullable',
    'foreignId journal_id journals nullable',
]);

$add('bank_accounts', 'BankAccount', 'Accounts', [
    'string name',
    'string account_no',
    'string bank_name',
    'foreignId currency_id currencies nullable',
    'foreignId gl_account_id accounts nullable',
    $money('balance'),
]);

$add('cheques', 'Cheque', 'Accounts', [
    'string cheque_no',
    'foreignId bank_account_id bank_accounts nullable',
    'foreignId party_id parties nullable',
    'string direction default:in',
    $money('amount'),
    'date cheque_date nullable',
    'string status default:pending',
    'bool is_pdc default:0',
]);

$add('bank_reconciliations', 'BankReconciliation', 'Accounts', [
    'foreignId bank_account_id bank_accounts nullable',
    'date statement_date',
    $money('statement_balance'),
    $money('book_balance'),
    $money('difference'),
    'string status default:open',
]);

$add('fixed_assets', 'FixedAsset', 'Accounts', [
    'string code unique',
    'string name',
    'foreignId asset_id assets nullable',
    'date acquired_on nullable',
    $money('cost'),
    $money('accumulated_depreciation'),
    'string method default:SLM',
    'decimal rate_pct 6,2 default:10',
    'integer useful_life_months default:120',
]);

$add('depreciations', 'Depreciation', 'Accounts', [
    'foreignId fixed_asset_id fixed_assets nullable',
    'date period_date',
    $money('amount'),
    'foreignId journal_id journals nullable',
]);

$add('budgets', 'Budget', 'Accounts', [
    'string name',
    'foreignId fiscal_year_id fiscal_years nullable',
    'foreignId cost_centre_id cost_centres nullable',
    $money('amount'),
    'string status default:draft',
]);

$add('budget_lines', 'BudgetLine', 'Accounts', [
    'foreignId budget_id budgets nullable',
    'foreignId account_id accounts nullable',
    'string period nullable',
    $money('amount'),
    $money('actual'),
]);

$add('tax_transactions', 'TaxTransaction', 'Accounts', [
    'foreignId tax_rule_id tax_rules nullable',
    'string source_type nullable',
    'unsignedInteger source_id nullable',
    'string direction default:output',
    $money('base_amount'),
    $money('tax_amount'),
    'date tax_date nullable',
    'string form_code nullable',
]);

$add('order_costs', 'OrderCost', 'Accounts', [
    'foreignId sales_order_id sales_orders nullable',
    'foreignId article_id fabric_articles nullable',
    $qty('metres'),
    $money('yarn'),
    $money('sizing'),
    $money('warping'),
    $money('drawing'),
    $money('weaving'),
    $money('finishing'),
    $money('packing'),
    $money('wastage'),
    $money('overhead'),
    $money('total'),
    $rate('cost_per_metre'),
    $money('revenue'),
    $money('profit'),
]);

$add('bank_loans', 'BankLoan', 'Accounts', [
    ...$doc,
    'foreignId bank_id parties nullable',
    'string loan_type default:CC',
    $money('principal'),
    'decimal interest_pct 6,2 default:9',
    'integer tenure_months default:12',
    $money('emi'),
    'date starts_on nullable',
]);

$add('attendances', 'Attendance', 'HR & Payroll', [
    'foreignId employee_id employees nullable',
    'date work_date',
    'foreignId shift_id shifts nullable',
    'datetime in_at nullable',
    'datetime out_at nullable',
    'integer late_minutes default:0',
    'integer ot_minutes default:0',
    'string status default:present',
    'string source default:manual',
]);

$add('leave_types', 'LeaveType', 'HR & Payroll', [
    'string code unique',
    'string name',
    'integer days_per_year default:0',
    'bool paid default:1',
], ['nobranch' => true]);

$add('leave_requests', 'LeaveRequest', 'HR & Payroll', [
    ...$doc,
    'foreignId employee_id employees nullable',
    'foreignId leave_type_id leave_types nullable',
    'date starts_on',
    'date ends_on',
    'text reason nullable',
]);

$add('wage_rates', 'WageRate', 'HR & Payroll', [
    'foreignId article_id fabric_articles nullable',
    'string basis default:per_metre',
    $rate('rate'),
    'date effective_from nullable',
]);

$add('payroll_runs', 'PayrollRun', 'HR & Payroll', [
    ...$doc,
    'string period',
    $money('total_net'),
]);

$add('payroll_lines', 'PayrollLine', 'HR & Payroll', [
    'foreignId payroll_run_id payroll_runs nullable',
    'foreignId employee_id employees nullable',
    $money('basic'),
    $money('piece'),
    $money('overtime'),
    $money('bonus'),
    $money('advance'),
    $money('deduction'),
    $money('tax'),
    $money('net'),
    'decimal metres 18,3 default:0',
    'integer picks default:0',
]);

$add('employee_loans', 'EmployeeLoan', 'HR & Payroll', [
    'foreignId employee_id employees nullable',
    $money('principal'),
    $money('balance'),
    $money('installment'),
    'string status default:open',
]);

$add('recruitments', 'Recruitment', 'HR & Payroll', [
    ...$doc,
    'string title',
    'foreignId department_id departments nullable',
    'integer openings default:1',
    'date closes_on nullable',
    'bool is_public default:1',
]);

$add('job_applications', 'JobApplication', 'HR & Payroll', [
    'foreignId recruitment_id recruitments nullable',
    'foreignId job_opening_id job_openings nullable',
    'string name',
    'string email nullable',
    'string phone nullable',
    'text cover_letter nullable',
    'string status default:received',
]);

$add('compliance_documents', 'ComplianceDocument', 'HR & Payroll', [
    'string name',
    'string category default:licence',
    'date issued_on nullable',
    'date expires_on nullable',
    'string file_path nullable',
]);

$add('accidents', 'Accident', 'HR & Payroll', [
    'datetime occurred_at nullable',
    'foreignId employee_id employees nullable',
    'string severity default:minor',
    'text description',
    'text action_taken nullable',
]);

$add('grievances', 'Grievance', 'HR & Payroll', [
    ...$doc,
    'foreignId employee_id employees nullable',
    'string subject',
    'text body',
    'bool anonymous default:0',
]);

$add('issue_rules', 'IssueRule', 'Issues', [
    'string code unique',
    'string name',
    'string module',
    'string severity default:medium',
    'bool enabled default:1',
    'json threshold nullable',
    'string assign_role nullable',
    'text description nullable',
], ['nobranch' => true]);

$add('issues', 'Issue', 'Issues', [
    'string number unique',
    'string issue_type default:production',
    'string severity default:medium',
    'string source default:manual',
    'string rule_code nullable',
    'string related_type nullable',
    'unsignedInteger related_id nullable',
    'foreignId department_id departments nullable',
    'foreignId assigned_to users nullable',
    'integer escalation_level default:0',
    'string status default:open',
    'datetime sla_due_at nullable',
    'text root_cause nullable',
    'json five_why nullable',
    'text corrective_action nullable',
    'text preventive_action nullable',
    $money('cost_impact'),
]);

$add('issue_comments', 'IssueComment', 'Issues', [
    'foreignId issue_id issues nullable',
    'foreignId user_id users nullable',
    'text body',
]);

$add('issue_actions', 'IssueAction', 'Issues', [
    'foreignId issue_id issues nullable',
    'string action',
    'foreignId user_id users nullable',
    'datetime acted_at nullable',
]);

$add('ai_prompt_templates', 'AiPromptTemplate', 'Issues', [
    'string code unique',
    'string name',
    'text prompt',
    'bool enabled default:1',
], ['nobranch' => true, 'label' => 'AI prompt templates']);

$add('pages', 'Page', 'Website', [
    'string title',
    'string slug',
    'string locale default:en',
    'text body nullable',
    'string meta_title nullable',
    'text meta_description nullable',
    'bool is_published default:0',
    'string template default:page',
], ['slug' => 'title', 'label' => 'CMS pages']);

$add('posts', 'Post', 'Website', [
    'string title',
    'string slug',
    'string locale default:en',
    'text excerpt nullable',
    'text body nullable',
    'datetime published_at nullable',
    'bool is_published default:0',
], ['slug' => 'title', 'label' => 'News']);

$add('certificates', 'Certificate', 'Website', [
    'string name',
    'string issuer nullable',
    'date issued_on nullable',
    'date expires_on nullable',
    'string file_path nullable',
    'bool is_public default:1',
]);

$add('job_openings', 'JobOpening', 'Website', [
    'string title',
    'string slug nullable',
    'foreignId department_id departments nullable',
    'foreignId recruitment_id recruitments nullable',
    'text description nullable',
    'date closes_on nullable',
    'bool is_published default:1',
]);

$add('gallery_items', 'GalleryItem', 'Website', [
    'string title',
    'string section default:facilities',
    'string image_path nullable',
    'text caption nullable',
    'integer sort_order default:0',
    'bool is_public default:1',
]);

$tables[] = [
    'alter' => 'users',
    'table' => 'users',
    'cols' => [
        'foreignId branch_id branches nullable',
        'foreignId unit_id units nullable',
        'foreignId employee_id employees nullable',
        'string locale default:en',
        'bool is_active default:1',
        'text two_factor_secret nullable',
        'datetime two_factor_confirmed_at nullable',
        'datetime last_login_at nullable',
        'string last_login_ip nullable',
    ],
];

return $tables;
