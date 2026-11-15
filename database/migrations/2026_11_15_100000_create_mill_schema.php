<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('symbol')->default('৳');
            $table->integer('decimal_places')->default(2);
            $table->boolean('is_base')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('legal_name');
            $table->string('country')->default('BD');
            $table->string('currency_code')->default('BDT');
            $table->string('timezone')->default('Asia/Dhaka');
            $table->string('tax_id')->nullable();
            $table->string('bin_vat')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('about')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->restrictOnDelete();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('address')->nullable();
            $table->boolean('finishing_enabled')->default(true);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('loom_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->string('code');
            $table->string('name');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cost_centres', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('type')->default('department');
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->time('starts_at');
            $table->time('ends_at');
            $table->integer('break_minutes')->default(0);
            $table->boolean('is_night')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->date('holiday_date');
            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->boolean('paid')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('fiscal_years', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('starts_on');
            $table->date('ends_on');
            $table->boolean('is_closed')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('fiscal_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_year_id')->constrained('fiscal_years')->restrictOnDelete();
            $table->string('name');
            $table->date('starts_on');
            $table->date('ends_on');
            $table->boolean('is_locked')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('number_series', function (Blueprint $table) {
            $table->id();
            $table->string('document_type');
            $table->string('prefix')->default('DOC');
            $table->integer('next_number')->default(1);
            $table->integer('padding')->default(5);
            $table->string('reset_rule')->default('yearly');
            $table->integer('year')->default(2026);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('group')->default('general');
            $table->text('value')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')->constrained('currencies')->restrictOnDelete();
            $table->date('rate_date');
            $table->decimal('rate', 18, 4)->default(0);
            $table->string('source')->default('manual');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('panel')->default('admin');
            $table->boolean('is_system')->default(true);
            $table->boolean('requires_two_factor')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('group')->default('general');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permission_id')->constrained('permissions')->restrictOnDelete();
            $table->foreignId('role_id')->constrained('roles')->restrictOnDelete();
        });

        Schema::create('field_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->restrictOnDelete();
            $table->string('resource');
            $table->string('field');
            $table->boolean('can_view')->default(false);
            $table->boolean('can_edit')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('approval_limits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->restrictOnDelete();
            $table->string('document_type');
            $table->decimal('max_amount', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('approval_flows', function (Blueprint $table) {
            $table->id();
            $table->string('document_type');
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('approval_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_flow_id')->constrained('approval_flows')->restrictOnDelete();
            $table->integer('step_no')->default(1);
            $table->string('role_slug');
            $table->decimal('min_amount', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('approval_requests', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('document_type');
            $table->unsignedInteger('document_id');
            $table->foreignId('approval_flow_id')->nullable()->constrained('approval_flows')->nullOnDelete();
            $table->integer('current_step')->default(1);
            $table->decimal('amount', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('approval_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_request_id')->constrained('approval_requests')->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action')->default('submitted');
            $table->text('comment')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('attachable_type');
            $table->unsignedInteger('attachable_id')->index();
            $table->string('disk')->default('public');
            $table->string('path');
            $table->string('name');
            $table->string('mime')->nullable();
            $table->unsignedInteger('size')->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('commentable_type');
            $table->unsignedInteger('commentable_id')->index();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('body');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('store_type')->default('yarn');
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouses')->restrictOnDelete();
            $table->string('code');
            $table->string('name');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('unit_of_measures', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('dimension')->default('length');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('uom_conversions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_uom_id')->constrained('unit_of_measures')->restrictOnDelete();
            $table->foreignId('to_uom_id')->constrained('unit_of_measures')->restrictOnDelete();
            $table->decimal('factor', 18, 6)->default(1);
            $table->unsignedBigInteger('article_id')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('type')->default('buyer');
            $table->string('country')->default('BD');
            $table->string('currency_code')->default('BDT');
            $table->decimal('credit_limit', 18, 2)->default(0);
            $table->integer('payment_days')->default(30);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('tax_id')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('party_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('party_id')->constrained('parties')->restrictOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('role_title')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('hs_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description');
            $table->decimal('duty_pct', 8, 3)->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tax_rules', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('country')->default('BD');
            $table->string('kind')->default('vat');
            $table->decimal('rate_pct', 8, 4)->default(0);
            $table->string('form_code')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('payment_terms', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('days')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('incoterms', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('ports', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('country')->default('BD');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('yarns', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->decimal('count_value', 10, 3)->default(40);
            $table->string('count_system')->default('Ne');
            $table->string('yarn_type')->default('combed');
            $table->decimal('cotton_pct', 6, 2)->default(100);
            $table->decimal('poly_pct', 6, 2)->default(0);
            $table->decimal('viscose_pct', 6, 2)->default(0);
            $table->string('twist_direction')->default('Z');
            $table->integer('ply')->default(1);
            $table->string('origin')->nullable();
            $table->string('mill_brand')->nullable();
            $table->string('colour')->default('raw-white');
            $table->decimal('cone_weight_kg', 10, 3)->default(2.083);
            $table->boolean('is_filament')->default(false);
            $table->decimal('standard_cost', 18, 4)->default(0);
            $table->decimal('reorder_kg', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('yarn_lots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('yarn_id')->nullable()->constrained('yarns')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->string('lot_no');
            $table->decimal('qty_kg', 18, 3)->default(0);
            $table->decimal('unit_cost', 18, 4)->default(0);
            $table->string('status')->default('available');
            $table->date('received_on')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('fabric_articles', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->foreignId('warp_yarn_id')->nullable()->constrained('yarns')->nullOnDelete();
            $table->foreignId('weft_yarn_id')->nullable()->constrained('yarns')->nullOnDelete();
            $table->decimal('epi', 8, 2)->default(0);
            $table->decimal('ppi', 8, 2)->default(0);
            $table->string('weave')->default('plain');
            $table->decimal('grey_width_cm', 8, 2)->default(0);
            $table->decimal('finished_width_cm', 8, 2)->default(0);
            $table->decimal('grey_gsm', 8, 2)->default(0);
            $table->decimal('finished_gsm', 8, 2)->default(0);
            $table->decimal('warp_shrinkage_pct', 6, 2)->default(0);
            $table->decimal('weft_shrinkage_pct', 6, 2)->default(0);
            $table->string('composition')->nullable();
            $table->string('finish_type')->nullable();
            $table->string('end_use')->nullable();
            $table->decimal('reed_count', 8, 2)->default(0);
            $table->decimal('reed_space_inch', 8, 2)->default(0);
            $table->integer('ends_per_dent')->default(2);
            $table->integer('selvedge_ends')->default(0);
            $table->string('selvedge_type')->nullable();
            $table->decimal('crimp_warp_pct', 6, 2)->default(8);
            $table->decimal('crimp_weft_pct', 6, 2)->default(6);
            $table->json('design_grid')->nullable();
            $table->integer('total_ends')->default(0);
            $table->decimal('warp_kg_per_100m', 18, 4)->default(0);
            $table->decimal('weft_kg_per_100m', 18, 4)->default(0);
            $table->decimal('calculated_gsm', 8, 2)->default(0);
            $table->decimal('expected_efficiency', 6, 2)->default(85);
            $table->decimal('metres_per_loom_shift', 18, 3)->default(0);
            $table->boolean('is_public')->default(false);
            $table->text('public_summary')->nullable();
            $table->string('image_path')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('chemicals', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('kind')->default('size');
            $table->string('uom')->default('kg');
            $table->decimal('standard_cost', 18, 4)->default(0);
            $table->integer('shelf_life_days')->default(180);
            $table->decimal('reorder_qty', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('size_recipes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->decimal('target_pickup_pct', 6, 2)->default(10);
            $table->text('notes')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('size_recipe_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('size_recipe_id')->nullable()->constrained('size_recipes')->nullOnDelete();
            $table->foreignId('chemical_id')->nullable()->constrained('chemicals')->nullOnDelete();
            $table->decimal('qty_per_kg', 18, 4)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('spares', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('criticality')->default('B');
            $table->decimal('min_qty', 18, 3)->default(0);
            $table->decimal('max_qty', 18, 3)->default(0);
            $table->integer('lead_time_days')->default(15);
            $table->decimal('standard_cost', 18, 4)->default(0);
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('packing_materials', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('kind')->default('carton');
            $table->decimal('standard_cost', 18, 4)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('machine_type')->default('loom');
            $table->string('make')->nullable();
            $table->string('model_name')->nullable();
            $table->string('shed_mechanism')->nullable();
            $table->integer('rpm')->default(550);
            $table->decimal('reed_width_cm', 8, 2)->default(190);
            $table->integer('selectors')->default(4);
            $table->integer('year_installed')->nullable();
            $table->decimal('motor_kw', 8, 2)->default(0);
            $table->string('location')->nullable();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('section_id')->nullable()->constrained('sections')->nullOnDelete();
            $table->string('status')->default('running');
            $table->boolean('is_public')->default(false);
            $table->integer('running_hours')->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('defects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->string('system')->default('both');
            $table->string('cause_category')->default('weaving');
            $table->text('corrective_action')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('nid')->nullable();
            $table->string('employment_type')->default('worker');
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->string('designation')->nullable();
            $table->string('grade')->nullable();
            $table->date('join_date')->nullable();
            $table->integer('skill_level')->default(1);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('basic_salary', 18, 2)->default(0);
            $table->string('bank_account')->nullable();
            $table->string('payment_channel')->default('bank');
            $table->boolean('is_active')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('company_name');
            $table->string('contact_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('source')->default('website');
            $table->string('country')->default('BD');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('lead_id')->nullable()->constrained('leads')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->string('subject');
            $table->text('requirement')->nullable();
            $table->date('needed_by')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->date('visited_on');
            $table->string('location')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->dateTime('met_at')->nullable();
            $table->string('subject');
            $table->text('minutes')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id')->nullable()->constrained('inquiries')->nullOnDelete();
            $table->date('due_on');
            $table->string('channel')->default('phone');
            $table->text('notes')->nullable();
            $table->boolean('is_done')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sample_requests', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('inquiry_id')->nullable()->constrained('inquiries')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->string('sample_type')->default('handloom');
            $table->string('shade')->nullable();
            $table->decimal('quantity_m', 18, 3)->default(0);
            $table->date('due_on')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('sample_request_id')->nullable()->constrained('sample_requests')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->string('shade')->nullable();
            $table->decimal('development_cost', 18, 2)->default(0);
            $table->text('buyer_comment')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cost_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->string('currency_code')->default('BDT');
            $table->decimal('yarn_cost_per_m', 18, 4)->default(0);
            $table->decimal('sizing_cost_per_m', 18, 4)->default(0);
            $table->decimal('weaving_cost_per_m', 18, 4)->default(0);
            $table->decimal('process_cost_per_m', 18, 4)->default(0);
            $table->decimal('overhead_per_m', 18, 4)->default(0);
            $table->decimal('finance_cost_per_m', 18, 4)->default(0);
            $table->decimal('commission_per_m', 18, 4)->default(0);
            $table->decimal('target_margin_pct', 6, 2)->default(12);
            $table->decimal('quoted_rate', 18, 4)->default(0);
            $table->date('valid_until')->nullable();
            $table->json('sensitivity')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cost_sheet_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cost_sheet_id')->nullable()->constrained('cost_sheets')->nullOnDelete();
            $table->string('component');
            $table->decimal('rate', 18, 4)->default(0);
            $table->decimal('quantity', 18, 3)->default(0);
            $table->decimal('amount', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('cost_sheet_id')->nullable()->constrained('cost_sheets')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->date('quote_date');
            $table->date('valid_until')->nullable();
            $table->decimal('total', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('quotation_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->nullable()->constrained('quotations')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->string('shade')->nullable();
            $table->decimal('quantity', 18, 3)->default(0);
            $table->string('uom')->default('m');
            $table->decimal('rate', 18, 4)->default(0);
            $table->decimal('amount', 18, 2)->default(0);
            $table->date('delivery_date')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('proforma_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('quotation_id')->nullable()->constrained('quotations')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->foreignId('payment_term_id')->nullable()->constrained('payment_terms')->nullOnDelete();
            $table->foreignId('incoterm_id')->nullable()->constrained('incoterms')->nullOnDelete();
            $table->date('pi_date');
            $table->decimal('total', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('proforma_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proforma_invoice_id')->nullable()->constrained('proforma_invoices')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->decimal('quantity', 18, 3)->default(0);
            $table->string('uom')->default('m');
            $table->decimal('rate', 18, 4)->default(0);
            $table->decimal('amount', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sales_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('proforma_invoice_id')->nullable()->constrained('proforma_invoices')->nullOnDelete();
            $table->string('contract_no')->nullable();
            $table->date('contract_date')->nullable();
            $table->decimal('amount', 18, 2)->default(0);
            $table->string('currency_code')->default('USD');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('letters_of_credit', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('lc_type')->default('export');
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('bank_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('sales_contract_id')->nullable()->constrained('sales_contracts')->nullOnDelete();
            $table->string('lc_number')->nullable();
            $table->decimal('amount', 18, 2)->default(0);
            $table->decimal('utilised', 18, 2)->default(0);
            $table->string('currency_code')->default('USD');
            $table->date('expiry_date')->nullable();
            $table->date('shipment_date')->nullable();
            $table->decimal('btb_limit_pct', 6, 2)->default(70);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('quotation_id')->nullable()->constrained('quotations')->nullOnDelete();
            $table->foreignId('sales_contract_id')->nullable()->constrained('sales_contracts')->nullOnDelete();
            $table->foreignId('lc_id')->nullable()->constrained('letters_of_credit')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->date('order_date');
            $table->date('delivery_date')->nullable();
            $table->decimal('tolerance_pct', 6, 2)->default(5);
            $table->decimal('total', 18, 2)->default(0);
            $table->decimal('margin_pct', 6, 2)->default(0);
            $table->json('feasibility')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sales_order_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_order_id')->nullable()->constrained('sales_orders')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->string('shade')->nullable();
            $table->decimal('width_cm', 8, 2)->default(0);
            $table->decimal('quantity', 18, 3)->default(0);
            $table->string('uom')->default('m');
            $table->decimal('rate', 18, 4)->default(0);
            $table->decimal('amount', 18, 2)->default(0);
            $table->date('delivery_date')->nullable();
            $table->decimal('tolerance_pct', 6, 2)->default(5);
            $table->decimal('produced_qty', 18, 3)->default(0);
            $table->decimal('dispatched_qty', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('price_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('price_list_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_list_id')->nullable()->constrained('price_lists')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->decimal('rate', 18, 4)->default(0);
            $table->decimal('discount_pct', 6, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('purchase_requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->string('source')->default('manual');
            $table->date('needed_by')->nullable();
            $table->decimal('estimated_total', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('purchase_requisition_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_requisition_id')->nullable()->constrained('purchase_requisitions')->nullOnDelete();
            $table->string('item_type')->default('yarn');
            $table->unsignedInteger('item_id')->nullable();
            $table->string('description');
            $table->decimal('quantity', 18, 3)->default(0);
            $table->string('uom')->default('kg');
            $table->decimal('estimated_rate', 18, 4)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('request_for_quotations', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('purchase_requisition_id')->nullable()->constrained('purchase_requisitions')->nullOnDelete();
            $table->date('due_on')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('rfq_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rfq_id')->nullable()->constrained('request_for_quotations')->nullOnDelete();
            $table->string('description');
            $table->decimal('quantity', 18, 3)->default(0);
            $table->string('uom')->default('kg');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('rfq_quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rfq_id')->nullable()->constrained('request_for_quotations')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->decimal('rate', 18, 4)->default(0);
            $table->integer('delivery_days')->default(0);
            $table->decimal('quality_score', 6, 2)->default(0);
            $table->integer('rank')->default(0);
            $table->boolean('is_selected')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('purchase_requisition_id')->nullable()->constrained('purchase_requisitions')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->foreignId('payment_term_id')->nullable()->constrained('payment_terms')->nullOnDelete();
            $table->foreignId('incoterm_id')->nullable()->constrained('incoterms')->nullOnDelete();
            $table->foreignId('lc_id')->nullable()->constrained('letters_of_credit')->nullOnDelete();
            $table->boolean('is_import')->default(false);
            $table->date('order_date');
            $table->date('delivery_date')->nullable();
            $table->decimal('total', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('purchase_order_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->nullable()->constrained('purchase_orders')->nullOnDelete();
            $table->string('item_type')->default('yarn');
            $table->unsignedInteger('item_id')->nullable();
            $table->foreignId('yarn_id')->nullable()->constrained('yarns')->nullOnDelete();
            $table->string('description');
            $table->decimal('quantity', 18, 3)->default(0);
            $table->decimal('received_qty', 18, 3)->default(0);
            $table->string('uom')->default('kg');
            $table->decimal('rate', 18, 4)->default(0);
            $table->decimal('amount', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('purchase_order_id')->nullable()->constrained('purchase_orders')->nullOnDelete();
            $table->string('bl_number')->nullable();
            $table->string('container_no')->nullable();
            $table->date('etd')->nullable();
            $table->date('eta')->nullable();
            $table->foreignId('port_id')->nullable()->constrained('ports')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bills_of_entry', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('shipment_id')->nullable()->constrained('shipments')->nullOnDelete();
            $table->string('be_number')->nullable();
            $table->date('be_date')->nullable();
            $table->decimal('assessable_value', 18, 2)->default(0);
            $table->decimal('duty', 18, 2)->default(0);
            $table->decimal('vat', 18, 2)->default(0);
            $table->decimal('other_charges', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('landed_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_of_entry_id')->nullable()->constrained('bills_of_entry')->nullOnDelete();
            $table->foreignId('purchase_order_id')->nullable()->constrained('purchase_orders')->nullOnDelete();
            $table->foreignId('yarn_lot_id')->nullable()->constrained('yarn_lots')->nullOnDelete();
            $table->decimal('invoice_amount', 18, 2)->default(0);
            $table->decimal('freight', 18, 2)->default(0);
            $table->decimal('insurance', 18, 2)->default(0);
            $table->decimal('duty', 18, 2)->default(0);
            $table->decimal('port_charges', 18, 2)->default(0);
            $table->decimal('cf_charges', 18, 2)->default(0);
            $table->decimal('quantity', 18, 3)->default(0);
            $table->decimal('unit_cost', 18, 4)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('supplier_claims', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('yarn_lot_id')->nullable()->constrained('yarn_lots')->nullOnDelete();
            $table->string('reason');
            $table->decimal('claimed_qty', 18, 3)->default(0);
            $table->decimal('amount', 18, 2)->default(0);
            $table->decimal('recovered', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('supplier_scorecards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->date('period_start');
            $table->date('period_end');
            $table->decimal('quality_score', 6, 2)->default(0);
            $table->decimal('delivery_score', 6, 2)->default(0);
            $table->decimal('price_score', 6, 2)->default(0);
            $table->decimal('claim_score', 6, 2)->default(0);
            $table->decimal('total_score', 6, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('goods_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('purchase_order_id')->nullable()->constrained('purchase_orders')->nullOnDelete();
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->nullOnDelete();
            $table->dateTime('received_at')->nullable();
            $table->string('qc_status')->default('quarantine');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('goods_receipt_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goods_receipt_id')->nullable()->constrained('goods_receipts')->nullOnDelete();
            $table->foreignId('purchase_order_line_id')->nullable()->constrained('purchase_order_lines')->nullOnDelete();
            $table->string('item_type')->default('yarn');
            $table->unsignedInteger('item_id')->nullable();
            $table->string('lot_no')->nullable();
            $table->decimal('quantity', 18, 3)->default(0);
            $table->decimal('accepted_qty', 18, 3)->default(0);
            $table->decimal('rejected_qty', 18, 3)->default(0);
            $table->string('uom')->default('kg');
            $table->decimal('unit_cost', 18, 4)->default(0);
            $table->string('qc_status')->default('quarantine');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('stock_lots', function (Blueprint $table) {
            $table->id();
            $table->string('item_type');
            $table->unsignedInteger('item_id');
            $table->string('lot_no');
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('yarn_lot_id')->nullable()->constrained('yarn_lots')->nullOnDelete();
            $table->decimal('qty', 18, 3)->default(0);
            $table->decimal('reserved_qty', 18, 3)->default(0);
            $table->string('uom')->default('kg');
            $table->decimal('unit_cost', 18, 4)->default(0);
            $table->string('status')->default('quarantine');
            $table->date('expiry_date')->nullable();
            $table->string('hold_reason')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('stock_moves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_lot_id')->nullable()->constrained('stock_lots')->nullOnDelete();
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->nullOnDelete();
            $table->foreignId('bin_id')->nullable()->constrained('bins')->nullOnDelete();
            $table->decimal('qty', 18, 3)->default(0);
            $table->string('uom')->default('kg');
            $table->decimal('unit_cost', 18, 4)->default(0);
            $table->string('move_type')->default('grn');
            $table->string('reference_type')->nullable();
            $table->unsignedInteger('reference_id')->nullable();
            $table->unsignedBigInteger('job_card_id')->nullable();
            $table->boolean('mix_approved')->default(false);
            $table->string('narration')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('stock_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->nullOnDelete();
            $table->foreignId('stock_lot_id')->nullable()->constrained('stock_lots')->nullOnDelete();
            $table->decimal('qty', 18, 3)->default(0);
            $table->decimal('value', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('stock_counts', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->nullOnDelete();
            $table->date('count_date');
            $table->string('count_type')->default('cyclic');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('stock_count_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_count_id')->nullable()->constrained('stock_counts')->nullOnDelete();
            $table->foreignId('stock_lot_id')->nullable()->constrained('stock_lots')->nullOnDelete();
            $table->decimal('book_qty', 18, 3)->default(0);
            $table->decimal('physical_qty', 18, 3)->default(0);
            $table->decimal('variance_qty', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('from_warehouse_id')->nullable()->constrained('warehouses')->nullOnDelete();
            $table->foreignId('to_warehouse_id')->nullable()->constrained('warehouses')->nullOnDelete();
            $table->string('transit_status')->default('draft');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('stock_transfer_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_transfer_id')->nullable()->constrained('stock_transfers')->nullOnDelete();
            $table->foreignId('stock_lot_id')->nullable()->constrained('stock_lots')->nullOnDelete();
            $table->decimal('quantity', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bill_of_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->decimal('warp_kg_per_100m', 18, 4)->default(0);
            $table->decimal('weft_kg_per_100m', 18, 4)->default(0);
            $table->decimal('size_addon_pct', 6, 2)->default(10);
            $table->decimal('waste_warping_pct', 6, 2)->default(1);
            $table->decimal('waste_sizing_pct', 6, 2)->default(0.5);
            $table->decimal('waste_drawing_pct', 6, 2)->default(0.2);
            $table->decimal('waste_weaving_pct', 6, 2)->default(2);
            $table->decimal('waste_inspection_pct', 6, 2)->default(1);
            $table->boolean('is_active')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bom_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bom_id')->nullable()->constrained('bill_of_materials')->nullOnDelete();
            $table->string('stage')->default('weaving');
            $table->string('item_type')->default('yarn');
            $table->unsignedInteger('item_id')->nullable();
            $table->decimal('qty_per_100m', 18, 4)->default(0);
            $table->string('uom')->default('kg');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('production_plans', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('sales_order_id')->nullable()->constrained('sales_orders')->nullOnDelete();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('yarn_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_plan_id')->nullable()->constrained('production_plans')->nullOnDelete();
            $table->foreignId('yarn_id')->nullable()->constrained('yarns')->nullOnDelete();
            $table->string('direction')->default('warp');
            $table->decimal('required_kg', 18, 3)->default(0);
            $table->decimal('available_kg', 18, 3)->default(0);
            $table->decimal('shortage_kg', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('beam_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_plan_id')->nullable()->constrained('production_plans')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->decimal('warp_length_m', 18, 3)->default(0);
            $table->integer('ends')->default(0);
            $table->integer('beam_count')->default(1);
            $table->decimal('beam_length_m', 18, 3)->default(0);
            $table->integer('cones')->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('loom_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_plan_id')->nullable()->constrained('production_plans')->nullOnDelete();
            $table->foreignId('loom_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('planned_metres', 18, 3)->default(0);
            $table->integer('style_change_minutes')->default(0);
            $table->string('status')->default('planned');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('job_cards', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('production_plan_id')->nullable()->constrained('production_plans')->nullOnDelete();
            $table->foreignId('sales_order_line_id')->nullable()->constrained('sales_order_lines')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->string('stage')->default('warping');
            $table->decimal('qty_m', 18, 3)->default(0);
            $table->string('barcode')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('warping_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('job_card_id')->nullable()->constrained('job_cards')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->foreignId('yarn_id')->nullable()->constrained('yarns')->nullOnDelete();
            $table->foreignId('yarn_lot_id')->nullable()->constrained('yarn_lots')->nullOnDelete();
            $table->foreignId('machine_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('operator_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->nullOnDelete();
            $table->integer('ends')->default(0);
            $table->decimal('beam_length_m', 18, 3)->default(0);
            $table->integer('speed')->default(0);
            $table->integer('stops')->default(0);
            $table->decimal('breakage_per_million', 10, 2)->default(0);
            $table->decimal('yarn_issued_kg', 18, 3)->default(0);
            $table->decimal('yarn_consumed_kg', 18, 3)->default(0);
            $table->decimal('soft_waste_kg', 18, 3)->default(0);
            $table->decimal('hard_waste_kg', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('warping_creel_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warping_job_id')->nullable()->constrained('warping_jobs')->nullOnDelete();
            $table->integer('position_no')->default(1);
            $table->foreignId('yarn_lot_id')->nullable()->constrained('yarn_lots')->nullOnDelete();
            $table->string('cone_barcode')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('section_beams', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('warping_job_id')->nullable()->constrained('warping_jobs')->nullOnDelete();
            $table->foreignId('machine_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('operator_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->integer('ends')->default(0);
            $table->decimal('length_m', 18, 3)->default(0);
            $table->decimal('gross_kg', 18, 3)->default(0);
            $table->decimal('net_kg', 18, 3)->default(0);
            $table->string('status')->default('in_stock');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sizing_batches', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('size_recipe_id')->nullable()->constrained('size_recipes')->nullOnDelete();
            $table->foreignId('machine_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->dateTime('cooked_at')->nullable();
            $table->decimal('viscosity', 8, 2)->default(0);
            $table->decimal('concentration', 8, 2)->default(0);
            $table->decimal('pickup_target', 6, 2)->default(10);
            $table->decimal('pickup_actual', 6, 2)->default(0);
            $table->decimal('moisture', 6, 2)->default(0);
            $table->decimal('stretch_pct', 6, 2)->default(0);
            $table->integer('speed')->default(0);
            $table->decimal('steam_pressure', 8, 2)->default(0);
            $table->decimal('chemical_kg', 18, 3)->default(0);
            $table->decimal('cost', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sizing_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sizing_batch_id')->nullable()->constrained('sizing_batches')->nullOnDelete();
            $table->foreignId('section_beam_id')->nullable()->constrained('section_beams')->nullOnDelete();
            $table->string('beam_no')->nullable();
            $table->decimal('warp_length_m', 18, 3)->default(0);
            $table->integer('speed')->default(0);
            $table->decimal('size_box_temp', 6, 2)->default(0);
            $table->decimal('squeeze_pressure', 8, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('weaver_beams', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('sizing_batch_id')->nullable()->constrained('sizing_batches')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->decimal('length_m', 18, 3)->default(0);
            $table->decimal('leftover_m', 18, 3)->default(0);
            $table->integer('ends')->default(0);
            $table->decimal('size_addon_pct', 6, 2)->default(0);
            $table->decimal('gross_kg', 18, 3)->default(0);
            $table->decimal('net_kg', 18, 3)->default(0);
            $table->string('grade')->default('A');
            $table->string('position')->default('store');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('drawing_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('weaver_beam_id')->nullable()->constrained('weaver_beams')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->unsignedBigInteger('reed_id')->nullable();
            $table->unsignedBigInteger('heald_frame_id')->nullable();
            $table->foreignId('operator_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->string('method')->default('fresh');
            $table->integer('wrong_draws')->default(0);
            $table->integer('double_ends')->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('reeds', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('reed_count', 8, 2)->default(0);
            $table->decimal('reed_space_cm', 8, 2)->default(0);
            $table->string('status')->default('in_stock');
            $table->integer('wear_score')->default(0);
            $table->foreignId('loom_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('heald_frames', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('frame_no')->default(1);
            $table->integer('wire_count')->default(0);
            $table->string('status')->default('in_stock');
            $table->foreignId('loom_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('loom_setups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loom_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->foreignId('weaver_beam_id')->nullable()->constrained('weaver_beams')->nullOnDelete();
            $table->foreignId('reed_id')->nullable()->constrained('reeds')->nullOnDelete();
            $table->integer('speed')->default(0);
            $table->text('settings')->nullable();
            $table->integer('setup_minutes')->default(0);
            $table->foreignId('operator_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('loom_productions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loom_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->nullOnDelete();
            $table->foreignId('operator_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->foreignId('job_card_id')->nullable()->constrained('job_cards')->nullOnDelete();
            $table->foreignId('weaver_beam_id')->nullable()->constrained('weaver_beams')->nullOnDelete();
            $table->date('production_date');
            $table->integer('picks')->default(0);
            $table->integer('rpm')->default(0);
            $table->integer('minutes')->default(480);
            $table->decimal('efficiency', 6, 2)->default(0);
            $table->decimal('metres', 18, 3)->default(0);
            $table->integer('warp_breaks')->default(0);
            $table->integer('weft_breaks')->default(0);
            $table->integer('stoppage_minutes')->default(0);
            $table->string('source')->default('kiosk');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('loom_stoppages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loom_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->nullOnDelete();
            $table->foreignId('operator_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->string('reason_code')->default('unspecified');
            $table->string('reason_bn')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->integer('minutes')->default(0);
            $table->string('source')->default('kiosk');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('fabric_rolls', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->foreignId('loom_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('operator_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->nullOnDelete();
            $table->foreignId('weaver_beam_id')->nullable()->constrained('weaver_beams')->nullOnDelete();
            $table->foreignId('sizing_batch_id')->nullable()->constrained('sizing_batches')->nullOnDelete();
            $table->foreignId('warp_lot_id')->nullable()->constrained('yarn_lots')->nullOnDelete();
            $table->foreignId('weft_lot_id')->nullable()->constrained('yarn_lots')->nullOnDelete();
            $table->foreignId('job_card_id')->nullable()->constrained('job_cards')->nullOnDelete();
            $table->decimal('length_m', 18, 3)->default(0);
            $table->decimal('weight_kg', 18, 3)->default(0);
            $table->decimal('grey_width_cm', 8, 2)->default(0);
            $table->decimal('gsm', 8, 2)->default(0);
            $table->string('grade')->nullable();
            $table->decimal('points', 10, 2)->default(0);
            $table->string('inspection_system')->default('4-point');
            $table->string('status')->default('grey');
            $table->dateTime('doffed_at')->nullable();
            $table->string('barcode')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('roll_defects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fabric_roll_id')->nullable()->constrained('fabric_rolls')->nullOnDelete();
            $table->foreignId('defect_id')->nullable()->constrained('defects')->nullOnDelete();
            $table->decimal('position_m', 18, 3)->default(0);
            $table->decimal('length_inch', 8, 2)->default(1);
            $table->integer('points')->default(1);
            $table->string('photo_path')->nullable();
            $table->foreignId('inspector_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->boolean('human_confirmed')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('finishing_batches', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->foreignId('subcontractor_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->string('process_route')->default('jobwork');
            $table->string('shade')->nullable();
            $table->decimal('grey_m', 18, 3)->default(0);
            $table->decimal('finished_m', 18, 3)->default(0);
            $table->decimal('process_loss_pct', 6, 2)->default(0);
            $table->decimal('rate_per_m', 18, 4)->default(0);
            $table->decimal('cost', 18, 2)->default(0);
            $table->boolean('is_reprocess')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('finishing_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('finishing_batch_id')->nullable()->constrained('finishing_batches')->nullOnDelete();
            $table->string('stage')->default('singeing');
            $table->json('parameters')->nullable();
            $table->string('result')->default('pending');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('jobwork_challans', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('subcontractor_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('finishing_batch_id')->nullable()->constrained('finishing_batches')->nullOnDelete();
            $table->string('direction')->default('out');
            $table->decimal('metres', 18, 3)->default(0);
            $table->date('challan_date')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('jobwork_challan_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobwork_challan_id')->nullable()->constrained('jobwork_challans')->nullOnDelete();
            $table->foreignId('fabric_roll_id')->nullable()->constrained('fabric_rolls')->nullOnDelete();
            $table->decimal('metres', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('packing_lists', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('sales_order_id')->nullable()->constrained('sales_orders')->nullOnDelete();
            $table->integer('cartons')->default(0);
            $table->decimal('gross_kg', 18, 3)->default(0);
            $table->decimal('net_kg', 18, 3)->default(0);
            $table->decimal('total_metres', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('packing_list_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packing_list_id')->nullable()->constrained('packing_lists')->nullOnDelete();
            $table->foreignId('fabric_roll_id')->nullable()->constrained('fabric_rolls')->nullOnDelete();
            $table->string('carton_no')->nullable();
            $table->decimal('metres', 18, 3)->default(0);
            $table->decimal('net_kg', 18, 3)->default(0);
            $table->decimal('gross_kg', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('test_packages', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->string('standard')->default('ISO');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('test_limits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_package_id')->nullable()->constrained('test_packages')->nullOnDelete();
            $table->string('parameter');
            $table->string('unit')->nullable();
            $table->decimal('min_value', 18, 4)->nullable();
            $table->decimal('max_value', 18, 4)->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->date('calibrated_on')->nullable();
            $table->date('calibration_due')->nullable();
            $table->string('certificate_no')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('lab_tests', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('sample_type')->default('yarn');
            $table->string('related_type')->nullable();
            $table->unsignedInteger('related_id')->nullable();
            $table->foreignId('test_package_id')->nullable()->constrained('test_packages')->nullOnDelete();
            $table->string('result')->default('pending');
            $table->dateTime('tested_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('lab_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_test_id')->nullable()->constrained('lab_tests')->nullOnDelete();
            $table->string('parameter');
            $table->string('value')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('min_limit', 18, 4)->nullable();
            $table->decimal('max_limit', 18, 4)->nullable();
            $table->boolean('passed')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('buyer_claims', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('fabric_roll_id')->nullable()->constrained('fabric_rolls')->nullOnDelete();
            $table->string('reason');
            $table->decimal('claimed_m', 18, 3)->default(0);
            $table->decimal('amount', 18, 2)->default(0);
            $table->text('root_cause')->nullable();
            $table->unsignedBigInteger('issue_id')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('machine_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->string('category')->default('loom');
            $table->date('commissioned_on')->nullable();
            $table->date('warranty_until')->nullable();
            $table->text('manual_ref')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pm_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->nullable()->constrained('assets')->nullOnDelete();
            $table->foreignId('machine_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->string('frequency')->default('weekly');
            $table->integer('every_hours')->default(0);
            $table->date('next_due')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pm_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pm_schedule_id')->nullable()->constrained('pm_schedules')->nullOnDelete();
            $table->string('task');
            $table->boolean('is_done')->default(false);
            $table->date('done_on')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('asset_id')->nullable()->constrained('assets')->nullOnDelete();
            $table->foreignId('machine_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('loom_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->string('work_type')->default('breakdown');
            $table->foreignId('mechanic_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->integer('downtime_minutes')->default(0);
            $table->text('root_cause')->nullable();
            $table->decimal('cost', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('work_order_spares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_order_id')->nullable()->constrained('work_orders')->nullOnDelete();
            $table->foreignId('spare_id')->nullable()->constrained('spares')->nullOnDelete();
            $table->decimal('quantity', 18, 3)->default(0);
            $table->decimal('cost', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('utility_readings', function (Blueprint $table) {
            $table->id();
            $table->date('reading_date');
            $table->string('utility')->default('power');
            $table->foreignId('section_id')->nullable()->constrained('sections')->nullOnDelete();
            $table->decimal('reading_value', 18, 3)->default(0);
            $table->string('uom')->default('kWh');
            $table->decimal('cost', 18, 2)->default(0);
            $table->decimal('metres_produced', 18, 3)->default(0);
            $table->decimal('cost_per_metre', 18, 4)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('etp_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('logged_at')->nullable();
            $table->decimal('inlet_ph', 6, 2)->default(0);
            $table->decimal('outlet_ph', 6, 2)->default(0);
            $table->decimal('inlet_bod', 8, 2)->default(0);
            $table->decimal('outlet_bod', 8, 2)->default(0);
            $table->decimal('sludge_kg', 18, 3)->default(0);
            $table->boolean('within_limit')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('amc_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->string('asset_scope')->nullable();
            $table->date('starts_on')->nullable();
            $table->date('ends_on')->nullable();
            $table->decimal('annual_value', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('dispatch_advices', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('sales_order_id')->nullable()->constrained('sales_orders')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('transporter_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->date('dispatch_date')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->decimal('metres', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('dispatch_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispatch_advice_id')->nullable()->constrained('dispatch_advices')->nullOnDelete();
            $table->foreignId('sales_order_line_id')->nullable()->constrained('sales_order_lines')->nullOnDelete();
            $table->foreignId('fabric_roll_id')->nullable()->constrained('fabric_rolls')->nullOnDelete();
            $table->decimal('metres', 18, 3)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('commercial_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('sales_order_id')->nullable()->constrained('sales_orders')->nullOnDelete();
            $table->foreignId('dispatch_advice_id')->nullable()->constrained('dispatch_advices')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->date('invoice_date');
            $table->decimal('amount', 18, 2)->default(0);
            $table->decimal('vat', 18, 2)->default(0);
            $table->decimal('total', 18, 2)->default(0);
            $table->string('mushak_form')->nullable();
            $table->boolean('is_export')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('commercial_invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commercial_invoice_id')->nullable()->constrained('commercial_invoices')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->string('description')->nullable();
            $table->decimal('quantity', 18, 3)->default(0);
            $table->string('uom')->default('m');
            $table->decimal('rate', 18, 4)->default(0);
            $table->decimal('amount', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('document_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lc_id')->nullable()->constrained('letters_of_credit')->nullOnDelete();
            $table->foreignId('commercial_invoice_id')->nullable()->constrained('commercial_invoices')->nullOnDelete();
            $table->string('document_name');
            $table->boolean('is_present')->default(false);
            $table->boolean('matches_lc')->default(false);
            $table->text('discrepancy')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('gate_passes', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('direction')->default('out');
            $table->foreignId('party_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->string('vehicle_no')->nullable();
            $table->string('driver')->nullable();
            $table->string('purpose')->nullable();
            $table->string('reference_type')->nullable();
            $table->unsignedInteger('reference_id')->nullable();
            $table->decimal('gross_weight', 18, 3)->default(0);
            $table->decimal('tare_weight', 18, 3)->default(0);
            $table->string('qr_token')->nullable();
            $table->boolean('returnable')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('gate_pass_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gate_pass_id')->nullable()->constrained('gate_passes')->nullOnDelete();
            $table->string('description');
            $table->decimal('quantity', 18, 3)->default(0);
            $table->string('uom')->default('kg');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('purpose')->nullable();
            $table->string('badge_no')->nullable();
            $table->dateTime('in_at')->nullable();
            $table->dateTime('out_at')->nullable();
            $table->string('host')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('security_rounds', function (Blueprint $table) {
            $table->id();
            $table->dateTime('rounded_at')->nullable();
            $table->string('area');
            $table->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->boolean('ok')->default(true);
            $table->text('notes')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('security_incidents', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('occurred_at')->nullable();
            $table->string('severity')->default('low');
            $table->text('description');
            $table->string('cctv_ref')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('account_type')->default('asset');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('is_postable')->default(true);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->date('journal_date');
            $table->string('source_type')->nullable();
            $table->unsignedInteger('source_id')->nullable();
            $table->string('purpose')->default('manual');
            $table->string('narration')->nullable();
            $table->string('status')->default('posted');
            $table->string('currency_code')->default('BDT');
            $table->decimal('total_debit', 18, 2)->default(0);
            $table->decimal('total_credit', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('journal_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')->nullable()->constrained('journals')->nullOnDelete();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->foreignId('cost_centre_id')->nullable()->constrained('cost_centres')->nullOnDelete();
            $table->decimal('debit', 18, 2)->default(0);
            $table->decimal('credit', 18, 2)->default(0);
            $table->string('narration')->nullable();
            $table->string('currency_code')->default('BDT');
            $table->decimal('fx_rate', 18, 6)->default(1);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('party_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->unsignedBigInteger('bank_account_id')->nullable();
            $table->decimal('amount', 18, 2)->default(0);
            $table->string('currency_code')->default('BDT');
            $table->string('method')->default('bank');
            $table->string('instrument_no')->nullable();
            $table->date('paid_on')->nullable();
            $table->foreignId('journal_id')->nullable()->constrained('journals')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('party_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->foreignId('commercial_invoice_id')->nullable()->constrained('commercial_invoices')->nullOnDelete();
            $table->unsignedBigInteger('bank_account_id')->nullable();
            $table->decimal('amount', 18, 2)->default(0);
            $table->string('currency_code')->default('BDT');
            $table->string('method')->default('bank');
            $table->date('received_on')->nullable();
            $table->foreignId('journal_id')->nullable()->constrained('journals')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('account_no');
            $table->string('bank_name');
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->foreignId('gl_account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->decimal('balance', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cheques', function (Blueprint $table) {
            $table->id();
            $table->string('cheque_no');
            $table->foreignId('bank_account_id')->nullable()->constrained('bank_accounts')->nullOnDelete();
            $table->foreignId('party_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->string('direction')->default('in');
            $table->decimal('amount', 18, 2)->default(0);
            $table->date('cheque_date')->nullable();
            $table->string('status')->default('pending');
            $table->boolean('is_pdc')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bank_reconciliations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_id')->nullable()->constrained('bank_accounts')->nullOnDelete();
            $table->date('statement_date');
            $table->decimal('statement_balance', 18, 2)->default(0);
            $table->decimal('book_balance', 18, 2)->default(0);
            $table->decimal('difference', 18, 2)->default(0);
            $table->string('status')->default('open');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('fixed_assets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('asset_id')->nullable()->constrained('assets')->nullOnDelete();
            $table->date('acquired_on')->nullable();
            $table->decimal('cost', 18, 2)->default(0);
            $table->decimal('accumulated_depreciation', 18, 2)->default(0);
            $table->string('method')->default('SLM');
            $table->decimal('rate_pct', 6, 2)->default(10);
            $table->integer('useful_life_months')->default(120);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('depreciations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixed_asset_id')->nullable()->constrained('fixed_assets')->nullOnDelete();
            $table->date('period_date');
            $table->decimal('amount', 18, 2)->default(0);
            $table->foreignId('journal_id')->nullable()->constrained('journals')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('fiscal_year_id')->nullable()->constrained('fiscal_years')->nullOnDelete();
            $table->foreignId('cost_centre_id')->nullable()->constrained('cost_centres')->nullOnDelete();
            $table->decimal('amount', 18, 2)->default(0);
            $table->string('status')->default('draft');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('budget_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_id')->nullable()->constrained('budgets')->nullOnDelete();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->string('period')->nullable();
            $table->decimal('amount', 18, 2)->default(0);
            $table->decimal('actual', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tax_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_rule_id')->nullable()->constrained('tax_rules')->nullOnDelete();
            $table->string('source_type')->nullable();
            $table->unsignedInteger('source_id')->nullable();
            $table->string('direction')->default('output');
            $table->decimal('base_amount', 18, 2)->default(0);
            $table->decimal('tax_amount', 18, 2)->default(0);
            $table->date('tax_date')->nullable();
            $table->string('form_code')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('order_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_order_id')->nullable()->constrained('sales_orders')->nullOnDelete();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->decimal('metres', 18, 3)->default(0);
            $table->decimal('yarn', 18, 2)->default(0);
            $table->decimal('sizing', 18, 2)->default(0);
            $table->decimal('warping', 18, 2)->default(0);
            $table->decimal('drawing', 18, 2)->default(0);
            $table->decimal('weaving', 18, 2)->default(0);
            $table->decimal('finishing', 18, 2)->default(0);
            $table->decimal('packing', 18, 2)->default(0);
            $table->decimal('wastage', 18, 2)->default(0);
            $table->decimal('overhead', 18, 2)->default(0);
            $table->decimal('total', 18, 2)->default(0);
            $table->decimal('cost_per_metre', 18, 4)->default(0);
            $table->decimal('revenue', 18, 2)->default(0);
            $table->decimal('profit', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bank_loans', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('bank_id')->nullable()->constrained('parties')->nullOnDelete();
            $table->string('loan_type')->default('CC');
            $table->decimal('principal', 18, 2)->default(0);
            $table->decimal('interest_pct', 6, 2)->default(9);
            $table->integer('tenure_months')->default(12);
            $table->decimal('emi', 18, 2)->default(0);
            $table->date('starts_on')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->date('work_date');
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->nullOnDelete();
            $table->dateTime('in_at')->nullable();
            $table->dateTime('out_at')->nullable();
            $table->integer('late_minutes')->default(0);
            $table->integer('ot_minutes')->default(0);
            $table->string('status')->default('present');
            $table->string('source')->default('manual');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('days_per_year')->default(0);
            $table->boolean('paid')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->foreignId('leave_type_id')->nullable()->constrained('leave_types')->nullOnDelete();
            $table->date('starts_on');
            $table->date('ends_on');
            $table->text('reason')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('wage_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->nullable()->constrained('fabric_articles')->nullOnDelete();
            $table->string('basis')->default('per_metre');
            $table->decimal('rate', 18, 4)->default(0);
            $table->date('effective_from')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('payroll_runs', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('period');
            $table->decimal('total_net', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('payroll_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_run_id')->nullable()->constrained('payroll_runs')->nullOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->decimal('basic', 18, 2)->default(0);
            $table->decimal('piece', 18, 2)->default(0);
            $table->decimal('overtime', 18, 2)->default(0);
            $table->decimal('bonus', 18, 2)->default(0);
            $table->decimal('advance', 18, 2)->default(0);
            $table->decimal('deduction', 18, 2)->default(0);
            $table->decimal('tax', 18, 2)->default(0);
            $table->decimal('net', 18, 2)->default(0);
            $table->decimal('metres', 18, 3)->default(0);
            $table->integer('picks')->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('employee_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->decimal('principal', 18, 2)->default(0);
            $table->decimal('balance', 18, 2)->default(0);
            $table->decimal('installment', 18, 2)->default(0);
            $table->string('status')->default('open');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->integer('openings')->default(1);
            $table->date('closes_on')->nullable();
            $table->boolean('is_public')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruitment_id')->nullable()->constrained('recruitments')->nullOnDelete();
            $table->unsignedBigInteger('job_opening_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('cover_letter')->nullable();
            $table->string('status')->default('received');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('compliance_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('licence');
            $table->date('issued_on')->nullable();
            $table->date('expires_on')->nullable();
            $table->string('file_path')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('accidents', function (Blueprint $table) {
            $table->id();
            $table->dateTime('occurred_at')->nullable();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->string('severity')->default('minor');
            $table->text('description');
            $table->text('action_taken')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('grievances', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('version')->default(1);
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->string('subject');
            $table->text('body');
            $table->boolean('anonymous')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('issue_rules', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('module');
            $table->string('severity')->default('medium');
            $table->boolean('enabled')->default(true);
            $table->json('threshold')->nullable();
            $table->string('assign_role')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('issue_type')->default('production');
            $table->string('severity')->default('medium');
            $table->string('source')->default('manual');
            $table->string('rule_code')->nullable();
            $table->string('related_type')->nullable();
            $table->unsignedInteger('related_id')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->integer('escalation_level')->default(0);
            $table->string('status')->default('open');
            $table->dateTime('sla_due_at')->nullable();
            $table->text('root_cause')->nullable();
            $table->json('five_why')->nullable();
            $table->text('corrective_action')->nullable();
            $table->text('preventive_action')->nullable();
            $table->decimal('cost_impact', 18, 2)->default(0);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('issue_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issue_id')->nullable()->constrained('issues')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('body');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('issue_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issue_id')->nullable()->constrained('issues')->nullOnDelete();
            $table->string('action');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('acted_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('ai_prompt_templates', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('prompt');
            $table->boolean('enabled')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('locale')->default('en');
            $table->text('body')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->string('template')->default('page');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('locale')->default('en');
            $table->text('excerpt')->nullable();
            $table->text('body')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->boolean('is_published')->default(false);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('issuer')->nullable();
            $table->date('issued_on')->nullable();
            $table->date('expires_on')->nullable();
            $table->string('file_path')->nullable();
            $table->boolean('is_public')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('recruitment_id')->nullable()->constrained('recruitments')->nullOnDelete();
            $table->text('description')->nullable();
            $table->date('closes_on')->nullable();
            $table->boolean('is_published')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('section')->default('facilities');
            $table->string('image_path')->nullable();
            $table->text('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_public')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->string('locale')->default('en');
            $table->boolean('is_active')->default(true);
            $table->text('two_factor_secret')->nullable();
            $table->dateTime('two_factor_confirmed_at')->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('users', function (Blueprint $table) {
            foreach (['branch_id', 'unit_id', 'employee_id'] as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropConstrainedForeignId($column);
                }
            }
            foreach (['locale', 'is_active', 'two_factor_secret', 'two_factor_confirmed_at', 'last_login_at', 'last_login_ip'] as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
            if (Schema::hasColumn('users', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
        Schema::dropIfExists('gallery_items');
        Schema::dropIfExists('job_openings');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('ai_prompt_templates');
        Schema::dropIfExists('issue_actions');
        Schema::dropIfExists('issue_comments');
        Schema::dropIfExists('issues');
        Schema::dropIfExists('issue_rules');
        Schema::dropIfExists('grievances');
        Schema::dropIfExists('accidents');
        Schema::dropIfExists('compliance_documents');
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('recruitments');
        Schema::dropIfExists('employee_loans');
        Schema::dropIfExists('payroll_lines');
        Schema::dropIfExists('payroll_runs');
        Schema::dropIfExists('wage_rates');
        Schema::dropIfExists('leave_requests');
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('bank_loans');
        Schema::dropIfExists('order_costs');
        Schema::dropIfExists('tax_transactions');
        Schema::dropIfExists('budget_lines');
        Schema::dropIfExists('budgets');
        Schema::dropIfExists('depreciations');
        Schema::dropIfExists('fixed_assets');
        Schema::dropIfExists('bank_reconciliations');
        Schema::dropIfExists('cheques');
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('receipts');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('journal_lines');
        Schema::dropIfExists('journals');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('security_incidents');
        Schema::dropIfExists('security_rounds');
        Schema::dropIfExists('visitors');
        Schema::dropIfExists('gate_pass_lines');
        Schema::dropIfExists('gate_passes');
        Schema::dropIfExists('document_checks');
        Schema::dropIfExists('commercial_invoice_lines');
        Schema::dropIfExists('commercial_invoices');
        Schema::dropIfExists('dispatch_lines');
        Schema::dropIfExists('dispatch_advices');
        Schema::dropIfExists('amc_contracts');
        Schema::dropIfExists('etp_logs');
        Schema::dropIfExists('utility_readings');
        Schema::dropIfExists('work_order_spares');
        Schema::dropIfExists('work_orders');
        Schema::dropIfExists('pm_tasks');
        Schema::dropIfExists('pm_schedules');
        Schema::dropIfExists('assets');
        Schema::dropIfExists('buyer_claims');
        Schema::dropIfExists('lab_test_results');
        Schema::dropIfExists('lab_tests');
        Schema::dropIfExists('instruments');
        Schema::dropIfExists('test_limits');
        Schema::dropIfExists('test_packages');
        Schema::dropIfExists('packing_list_lines');
        Schema::dropIfExists('packing_lists');
        Schema::dropIfExists('jobwork_challan_lines');
        Schema::dropIfExists('jobwork_challans');
        Schema::dropIfExists('finishing_stages');
        Schema::dropIfExists('finishing_batches');
        Schema::dropIfExists('roll_defects');
        Schema::dropIfExists('fabric_rolls');
        Schema::dropIfExists('loom_stoppages');
        Schema::dropIfExists('loom_productions');
        Schema::dropIfExists('loom_setups');
        Schema::dropIfExists('heald_frames');
        Schema::dropIfExists('reeds');
        Schema::dropIfExists('drawing_jobs');
        Schema::dropIfExists('weaver_beams');
        Schema::dropIfExists('sizing_logs');
        Schema::dropIfExists('sizing_batches');
        Schema::dropIfExists('section_beams');
        Schema::dropIfExists('warping_creel_positions');
        Schema::dropIfExists('warping_jobs');
        Schema::dropIfExists('job_cards');
        Schema::dropIfExists('loom_allocations');
        Schema::dropIfExists('beam_plans');
        Schema::dropIfExists('yarn_requirements');
        Schema::dropIfExists('production_plans');
        Schema::dropIfExists('bom_lines');
        Schema::dropIfExists('bill_of_materials');
        Schema::dropIfExists('stock_transfer_lines');
        Schema::dropIfExists('stock_transfers');
        Schema::dropIfExists('stock_count_lines');
        Schema::dropIfExists('stock_counts');
        Schema::dropIfExists('stock_balances');
        Schema::dropIfExists('stock_moves');
        Schema::dropIfExists('stock_lots');
        Schema::dropIfExists('goods_receipt_lines');
        Schema::dropIfExists('goods_receipts');
        Schema::dropIfExists('supplier_scorecards');
        Schema::dropIfExists('supplier_claims');
        Schema::dropIfExists('landed_costs');
        Schema::dropIfExists('bills_of_entry');
        Schema::dropIfExists('shipments');
        Schema::dropIfExists('purchase_order_lines');
        Schema::dropIfExists('purchase_orders');
        Schema::dropIfExists('rfq_quotes');
        Schema::dropIfExists('rfq_lines');
        Schema::dropIfExists('request_for_quotations');
        Schema::dropIfExists('purchase_requisition_lines');
        Schema::dropIfExists('purchase_requisitions');
        Schema::dropIfExists('price_list_lines');
        Schema::dropIfExists('price_lists');
        Schema::dropIfExists('sales_order_lines');
        Schema::dropIfExists('sales_orders');
        Schema::dropIfExists('letters_of_credit');
        Schema::dropIfExists('sales_contracts');
        Schema::dropIfExists('proforma_lines');
        Schema::dropIfExists('proforma_invoices');
        Schema::dropIfExists('quotation_lines');
        Schema::dropIfExists('quotations');
        Schema::dropIfExists('cost_sheet_lines');
        Schema::dropIfExists('cost_sheets');
        Schema::dropIfExists('samples');
        Schema::dropIfExists('sample_requests');
        Schema::dropIfExists('follow_ups');
        Schema::dropIfExists('meetings');
        Schema::dropIfExists('visits');
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('defects');
        Schema::dropIfExists('machines');
        Schema::dropIfExists('packing_materials');
        Schema::dropIfExists('spares');
        Schema::dropIfExists('size_recipe_items');
        Schema::dropIfExists('size_recipes');
        Schema::dropIfExists('chemicals');
        Schema::dropIfExists('fabric_articles');
        Schema::dropIfExists('yarn_lots');
        Schema::dropIfExists('yarns');
        Schema::dropIfExists('ports');
        Schema::dropIfExists('incoterms');
        Schema::dropIfExists('payment_terms');
        Schema::dropIfExists('tax_rules');
        Schema::dropIfExists('hs_codes');
        Schema::dropIfExists('party_contacts');
        Schema::dropIfExists('parties');
        Schema::dropIfExists('uom_conversions');
        Schema::dropIfExists('unit_of_measures');
        Schema::dropIfExists('bins');
        Schema::dropIfExists('warehouses');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('attachments');
        Schema::dropIfExists('approval_actions');
        Schema::dropIfExists('approval_requests');
        Schema::dropIfExists('approval_steps');
        Schema::dropIfExists('approval_flows');
        Schema::dropIfExists('approval_limits');
        Schema::dropIfExists('field_permissions');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('exchange_rates');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('number_series');
        Schema::dropIfExists('fiscal_periods');
        Schema::dropIfExists('fiscal_years');
        Schema::dropIfExists('holidays');
        Schema::dropIfExists('shifts');
        Schema::dropIfExists('cost_centres');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('units');
        Schema::dropIfExists('branches');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('currencies');
        Schema::enableForeignKeyConstraints();
    }
};
