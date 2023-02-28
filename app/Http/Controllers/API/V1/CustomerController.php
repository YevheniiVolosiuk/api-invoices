<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStoreCustomerRequest;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use App\Filters\V1\CustomerFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): CustomerCollection
    {
        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request); // (['column', 'operator', 'value'])

        $includeInvoice = $request->query('includeInvoices');

        $customers = Customer::where($filterItems);

        if (isset($includeInvoice)) {
            $customers = $customers->with('invoices');
        }

        return new CustomerCollection($customers->paginate()->appends($request->query()));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    public function bulkStore(BulkStoreCustomerRequest $request): void
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, ['firstName', 'lastName', 'postalCode']);
        });

        Customer::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,  Customer $customer): CustomerResource
    {
        $includeInvoice = $request->query('includeInvoices');

        if (isset($includeInvoice)){
            return new CustomerResource($customer->loadMissing('invoices'));
        }

        return new CustomerResource($customer);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): void
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
    }
}
