<?php

use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->nullable();
            $table->string('name');
            $table->string('quantity');
            $table->foreignIdFor(User::class);
            $table->string('description');
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Supplier::class);
            $table->string('status')->default('inactive');
            $table->string('log_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
