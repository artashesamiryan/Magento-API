<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderAppliedTax;
use App\Models\OrderBillingAddress;
use App\Models\OrderItem;
use App\Models\OrderItemAppliedTax;
use App\Models\OrderItemOption;
use App\Models\OrderPayment;
use App\Models\OrderPaymentInfo;
use App\Models\OrderStatusHistory;
use App\Models\Shipping;
use App\Models\ShippingAddress;
use App\Models\ShippingItem;
use App\Models\ShippingItemOption;
use App\Models\ShippingTotal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderRepository
{
    /**
     * fetch
     *
     * @param Request $request
     * @return void
     */
    public function fetch(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->header('token'),
            'Accept' => 'application/json',
        ])->get(
            'http://59.92.233.19/magento/rest/V1/orders',
            [
                'searchCriteria[pageSize]' => '0'
            ]
        );
        // dd($response->json());


        if ($response->successful()) {
            foreach ($response->json()['items'] as $item) {
                $o = new Order;
                $o->applied_rule_ids = $item['applied_rule_ids'];
                $o->base_currency_code = $item['base_currency_code'];
                $o->base_discount_amount = $item['base_discount_amount'];
                $o->base_discount_invoiced = $item['base_discount_invoiced'];
                $o->base_grand_total = $item['base_grand_total'];
                $o->base_discount_tax_compensation_amount = $item['base_discount_tax_compensation_amount'];
                $o->base_discount_tax_compensation_invoiced = $item['base_discount_tax_compensation_invoiced'];
                $o->base_shipping_amount = $item['base_shipping_amount'];
                $o->base_shipping_discount_amount = $item['base_shipping_discount_amount'];
                $o->base_shipping_discount_tax_compensation_amnt = $item['base_shipping_discount_tax_compensation_amnt'];
                $o->base_shipping_incl_tax = $item['base_shipping_incl_tax'];
                $o->base_shipping_invoiced = $item['base_shipping_invoiced'];
                $o->base_shipping_tax_amount = $item['base_shipping_tax_amount'];
                $o->base_subtotal = $item['base_subtotal'];
                $o->base_subtotal_incl_tax = $item['base_subtotal_incl_tax'];
                $o->base_subtotal_invoiced = $item['base_subtotal_invoiced'];
                $o->base_tax_amount = $item['base_tax_amount'];
                $o->base_tax_invoiced = $item['base_tax_invoiced'];
                $o->base_total_due = $item['base_total_due'];
                $o->base_total_invoiced = $item['base_total_invoiced'];
                $o->base_total_invoiced_cost = $item['base_total_invoiced_cost'];
                $o->base_total_paid = $item['base_total_paid'];
                $o->base_to_global_rate = $item['base_to_global_rate'];
                $o->base_to_order_rate = $item['base_to_order_rate'];
                $o->billing_address_id = $item['billing_address_id'];
                $o->created_at = $item['created_at'];
                $o->customer_dob = $item['customer_dob'];
                $o->customer_email = $item['customer_email'];
                $o->customer_firstname = $item['customer_firstname'];
                $o->customer_gender = $item['customer_gender'];
                $o->customer_group_id = $item['customer_group_id'];
                $o->customer_id = $item['customer_id'];
                $o->customer_is_guest = $item['customer_is_guest'];
                $o->customer_lastname = $item['customer_lastname'];
                $o->customer_note_notify = $item['customer_note_notify'];
                $o->discount_amount = $item['discount_amount'];
                $o->discount_invoiced = $item['discount_invoiced'];
                $o->entity_id = $item['entity_id'];
                $o->global_currency_code = $item['global_currency_code'];
                $o->grand_total = $item['grand_total'];
                $o->discount_tax_compensation_amount = $item['discount_tax_compensation_amount'];
                $o->discount_tax_compensation_invoiced = $item['discount_tax_compensation_invoiced'];
                $o->increment_id = $item['increment_id'];
                $o->is_virtual = $item['is_virtual'];
                $o->order_currency_code = $item['order_currency_code'];
                $o->protect_code = $item['protect_code'];
                $o->quote_id = $item['quote_id'];
                $o->shipping_amount = $item['shipping_amount'];
                $o->shipping_description = $item['shipping_description'];
                $o->shipping_discount_amount = $item['shipping_discount_amount'];
                $o->shipping_discount_tax_compensation_amount = $item['shipping_discount_tax_compensation_amount'];
                $o->shipping_incl_tax = $item['shipping_incl_tax'];
                $o->shipping_invoiced = $item['shipping_invoiced'];
                $o->shipping_tax_amount = $item['shipping_tax_amount'];
                $o->state = $item['state'];
                $o->status = $item['status'];
                $o->store_currency_code = $item['store_currency_code'];
                $o->store_id = $item['store_id'];
                $o->store_name = $item['store_name'];
                $o->store_to_base_rate = $item['store_to_base_rate'];
                $o->store_to_order_rate = $item['store_to_order_rate'];
                $o->subtotal = $item['subtotal'];
                $o->subtotal_incl_tax = $item['subtotal_incl_tax'];
                $o->subtotal_invoiced = $item['subtotal_invoiced'];
                $o->tax_amount = $item['tax_amount'];
                $o->tax_invoiced = $item['tax_invoiced'];
                $o->total_due = $item['total_due'];
                $o->total_invoiced = $item['total_invoiced'];
                $o->total_item_count = $item['total_item_count'];
                $o->total_paid = $item['total_paid'];
                $o->total_qty_ordered = $item['total_qty_ordered'];
                $o->updated_at = $item['updated_at'];
                $o->weight = $item['weight'];
                $o->save();

                foreach ($item['items'] as $oitem) {
                    $oi = new OrderItem;
                    $oi->order_id = $o->id;
                    $oi->amount_refunded = $oitem['amount_refunded'];
                    $oi->applied_rule_ids = $oitem['applied_rule_ids'];
                    $oi->base_amount_refunded = $oitem['base_amount_refunded'];
                    $oi->base_discount_amount = $oitem['base_discount_amount'];
                    $oi->base_discount_invoiced = $oitem['base_discount_invoiced'];
                    $oi->base_discount_tax_compensation_amount = $oitem['base_discount_tax_compensation_amount'];
                    $oi->base_discount_tax_compensation_invoiced = $oitem['base_discount_tax_compensation_invoiced'];
                    $oi->base_original_price = $oitem['base_original_price'];
                    $oi->base_price = $oitem['base_price'];
                    $oi->base_price_incl_tax = $oitem['base_price_incl_tax'];
                    $oi->base_row_invoiced = $oitem['base_row_invoiced'];
                    $oi->base_row_total = $oitem['base_row_total'];
                    $oi->base_row_total_incl_tax = $oitem['base_row_total_incl_tax'];
                    $oi->base_tax_amount = $oitem['base_tax_amount'];
                    $oi->base_tax_invoiced = $oitem['base_tax_invoiced'];
                    $oi->created_at = $oitem['created_at'];
                    $oi->discount_amount = $oitem['discount_amount'];
                    $oi->discount_invoiced = $oitem['discount_invoiced'];
                    $oi->discount_percent = $oitem['discount_percent'];
                    $oi->free_shipping = $oitem['free_shipping'];
                    $oi->discount_tax_compensation_amount = $oitem['discount_tax_compensation_amount'];
                    $oi->discount_tax_compensation_invoiced = $oitem['discount_tax_compensation_invoiced'];
                    $oi->is_qty_decimal = $oitem['is_qty_decimal'];
                    $oi->item_id = $oitem['item_id'];
                    $oi->name = $oitem['name'];
                    $oi->no_discount = $oitem['no_discount'];
                    $oi->original_price = $oitem['original_price'];
                    $oi->price = $oitem['price'];
                    $oi->price_incl_tax = $oitem['price_incl_tax'];
                    $oi->product_id = $oitem['product_id'];
                    $oi->product_type = $oitem['product_type'];
                    $oi->qty_canceled = $oitem['qty_canceled'];
                    $oi->qty_invoiced = $oitem['qty_invoiced'];
                    $oi->qty_ordered = $oitem['qty_ordered'];
                    $oi->qty_refunded = $oitem['qty_refunded'];
                    $oi->qty_shipped = $oitem['qty_shipped'];
                    $oi->row_invoiced = $oitem['row_invoiced'];
                    $oi->row_total = $oitem['row_total'];
                    $oi->row_total_incl_tax = $oitem['row_total_incl_tax'];
                    $oi->row_weight = $oitem['row_weight'];
                    $oi->sku = $oitem['sku'];
                    $oi->store_id = $oitem['store_id'];
                    $oi->tax_amount = $oitem['tax_amount'];
                    $oi->tax_invoiced = $oitem['tax_invoiced'];
                    $oi->tax_percent = $oitem['tax_percent'];
                    $oi->updated_at = $oitem['updated_at'];
                    $oi->weight = $oitem['weight'];
                    $oi->save();


                    if (isset($oitem['product_option']['extension_attributes']['configurable_item_options'])) {
                        $options = $oitem['product_option']['extension_attributes']['configurable_item_options'];

                        foreach ($options as $option) {
                            $oio = new OrderItemOption;
                            $oio->order_item_id = $oi->id;
                            $oio->option_id = $option['option_id'];
                            $oio->option_value = $option['option_value'];
                            $oio->save();
                        }
                    }
                }

                if (isset($item['billing_address'])) {
                    $address = $item['billing_address'];

                    $oba = new OrderBillingAddress;
                    $oba->order_id = $o->id;
                    $oba->address_type = $address['address_type'];
                    $oba->city = $address['city'];
                    $oba->country_id = $address['country_id'];
                    $oba->customer_address_id = $address['customer_address_id'];
                    $oba->email = $address['email'];
                    $oba->entity_id = $address['entity_id'];
                    $oba->firstname = $address['firstname'];
                    $oba->lastname = $address['lastname'];
                    $oba->parent_id = $address['parent_id'];
                    $oba->postcode = $address['postcode'];
                    $oba->region = $address['region'];
                    $oba->region_code = $address['region_code'];
                    $oba->region_id = $address['region_id'];
                    $oba->street = implode(',', $address['street']);
                    $oba->telephone = $address['telephone'];
                    $oba->save();
                }

                if (isset($item['payment'])) {
                    $payment = $item['payment'];

                    $op = new OrderPayment;
                    $op->order_id = $o->id;
                    $op->additional_information = implode(',', $payment['additional_information']);
                    $op->amount_ordered = $payment['amount_ordered'];
                    $op->amount_paid = $payment['amount_paid'];
                    $op->base_amount_ordered = $payment['base_amount_ordered'];
                    $op->base_amount_paid = $payment['base_amount_paid'];
                    $op->base_shipping_amount = $payment['base_shipping_amount'];
                    $op->base_shipping_captured = $payment['base_shipping_captured'];
                    $op->cc_last4 = $payment['cc_last4'];
                    $op->entity_id = $payment['entity_id'];
                    $op->method = $payment['method'];
                    $op->parent_id = $payment['parent_id'];
                    $op->shipping_amount = $payment['shipping_amount'];
                    $op->shipping_captured = $payment['shipping_captured'];
                    $op->save();
                }

                if (isset($item['status_histories'])) {
                    foreach ($item['status_histories'] as $history) {
                        $osh = new OrderStatusHistory;
                        $osh->order_id = $o->id;
                        $osh->comment = $history['comment'];
                        $osh->created_at = $history['created_at'];
                        $osh->entity_id = $history['entity_id'];
                        $osh->entity_name = $history['entity_name'];
                        $osh->is_customer_notified = $history['is_customer_notified'];
                        $osh->is_visible_on_front = $history['is_visible_on_front'];
                        $osh->parent_id = $history['parent_id'];
                        $osh->status = $history['status'];
                        $osh->save();
                    }
                }


                //
                // ──────────────────────────────────────────────────────── I ──────────
                //   :::::: S H I P P I N G : :  :   :    :     :        :          :
                // ──────────────────────────────────────────────────────────────────
                //
                if (isset($item['extension_attributes']['shipping_assignments'][0]['shipping'])) {
                    $shipping = $item['extension_attributes']['shipping_assignments'][0]['shipping'];

                    $s = new Shipping;
                    $s->order_id = $o->id;
                    $s->method = $shipping['method'];
                    $s->save();

                    $saddress = $shipping['address'];

                    $sa = new ShippingAddress;
                    $sa->shipping_id = $s->id;
                    $sa->address_type = $saddress['address_type'];
                    $sa->city = $saddress['city'];
                    $sa->country_id = $saddress['country_id'];
                    $sa->customer_address_id = $saddress['customer_address_id'];
                    $sa->email = $saddress['email'];
                    $sa->entity_id = $saddress['entity_id'];
                    $sa->firstname = $saddress['firstname'];
                    $sa->lastname = $saddress['lastname'];
                    $sa->parent_id = $saddress['parent_id'];
                    $sa->postcode = $saddress['postcode'];
                    $sa->region = $saddress['region'];
                    $sa->region_code = $saddress['region_code'];
                    $sa->region_id = $saddress['region_id'];
                    $sa->street = implode(',', $saddress['street']);
                    $sa->telephone = $saddress['telephone'];
                    $sa->save();

                    $totals = $shipping['total'];

                    $st = new ShippingTotal;
                    $st->shipping_id = $s->id;
                    $st->base_shipping_amount = $totals['base_shipping_amount'];
                    $st->base_shipping_discount_amount = $totals['base_shipping_discount_amount'];
                    $st->base_shipping_discount_tax_compensation_amnt = $totals['base_shipping_discount_tax_compensation_amnt'];
                    $st->base_shipping_incl_tax = $totals['base_shipping_incl_tax'];
                    $st->base_shipping_invoiced = $totals['base_shipping_invoiced'];
                    $st->base_shipping_refunded = isset($totals['base_shipping_refunded']) ? $totals['base_shipping_refunded'] : null;
                    $st->base_shipping_tax_amount = $totals['base_shipping_tax_amount'];
                    $st->base_shipping_tax_refunded = isset($totals['base_shipping_tax_refunded']) ? $totals['base_shipping_tax_refunded'] : null;
                    $st->shipping_amount = $totals['shipping_amount'];
                    $st->shipping_discount_amount = $totals['shipping_discount_amount'];
                    $st->shipping_discount_tax_compensation_amount = $totals['shipping_discount_tax_compensation_amount'];
                    $st->shipping_incl_tax = $totals['shipping_incl_tax'];
                    $st->shipping_invoiced = $totals['shipping_invoiced'];
                    $st->shipping_refunded = isset($totals['shipping_refunded']) ? $totals['shipping_refunded'] : null;
                    $st->shipping_tax_amount = $totals['shipping_tax_amount'];
                    $st->shipping_tax_refunded = isset($totals['shipping_tax_refunded']) ? $totals['shipping_tax_refunded'] : null;
                    $st->save();
                    
                    if (isset($item['extension_attributes']['shipping_assignments'][0]['items'])) {
                        foreach ($item['extension_attributes']['shipping_assignments'][0]['items'] as $sitem) {
                            $si = new ShippingItem;
                            $si->shipping_id = $s->id;
                            $si->amount_refunded = $sitem['amount_refunded'];
                            $si->applied_rule_ids = $sitem['applied_rule_ids'];
                            $si->base_amount_refunded = $sitem['base_amount_refunded'];
                            $si->base_discount_amount = $sitem['base_discount_amount'];
                            $si->base_discount_invoiced = $sitem['base_discount_invoiced'];
                            $si->base_discount_tax_compensation_amount = $sitem['base_discount_tax_compensation_amount'];
                            $si->base_discount_tax_compensation_invoiced = $sitem['base_discount_tax_compensation_invoiced'];
                            $si->base_original_price = $sitem['base_original_price'];
                            $si->base_price = $sitem['base_price'];
                            $si->base_price_incl_tax = $sitem['base_price_incl_tax'];
                            $si->base_row_invoiced = $sitem['base_row_invoiced'];
                            $si->base_row_total = $sitem['base_row_total'];
                            $si->base_row_total_incl_tax = $sitem['base_row_total_incl_tax'];
                            $si->base_tax_amount = $sitem['base_tax_amount'];
                            $si->base_tax_invoiced = $sitem['base_tax_invoiced'];
                            $si->created_at = $sitem['created_at'];
                            $si->discount_amount = $sitem['discount_amount'];
                            $si->discount_invoiced = $sitem['discount_invoiced'];
                            $si->discount_percent = $sitem['discount_percent'];
                            $si->free_shipping = $sitem['free_shipping'];
                            $si->discount_tax_compensation_amount = $sitem['discount_tax_compensation_amount'];
                            $si->discount_tax_compensation_invoiced = $sitem['discount_tax_compensation_invoiced'];
                            $si->is_qty_decimal = $sitem['is_qty_decimal'];
                            $si->item_id = $sitem['item_id'];
                            $si->name = $sitem['name'];
                            $si->no_discount = $sitem['no_discount'];
                            $si->order_id = $sitem['order_id'];
                            $si->original_price = $sitem['original_price'];
                            $si->price = $sitem['price'];
                            $si->price_incl_tax = $sitem['price_incl_tax'];
                            $si->product_id = $sitem['product_id'];
                            $si->product_type = $sitem['product_type'];
                            $si->qty_canceled = $sitem['qty_canceled'];
                            $si->qty_invoiced = $sitem['qty_invoiced'];
                            $si->qty_ordered = $sitem['qty_ordered'];
                            $si->qty_refunded = $sitem['qty_refunded'];
                            $si->qty_shipped = $sitem['qty_shipped'];
                            $si->row_invoiced = $sitem['row_invoiced'];
                            $si->row_total = $sitem['row_total'];
                            $si->row_total_incl_tax = $sitem['row_total_incl_tax'];
                            $si->row_weight = $sitem['row_weight'];
                            $si->sku = $sitem['sku'];
                            $si->store_id = $sitem['store_id'];
                            $si->tax_amount = $sitem['tax_amount'];
                            $si->tax_invoiced = $sitem['tax_invoiced'];
                            $si->tax_percent = $sitem['tax_percent'];
                            $si->updated_at = $sitem['updated_at'];
                            $si->weight = $sitem['weight'];
                            $si->save();

                            if (isset($sitem['product_option']['extension_attributes']['configurable_item_options'])) {
                                $options = $sitem['product_option']['extension_attributes']['configurable_item_options'];

                                foreach ($options as $option) {
                                    $sio = new ShippingItemOption;
                                    $sio->item_id = $si->id;
                                    $sio->option_id = $option['option_id'];
                                    $sio->option_value = $option['option_value'];
                                    $sio->save();
                                }
                            }
                        }
                    }
                }

                //
                // ──────────────────────────────────────────────────────────────── I ──────────
                //   :::::: E N D   S H I P P I N G : :  :   :    :     :        :          :
                // ──────────────────────────────────────────────────────────────────────────
                //

                if (isset($item['extension_attributes']['payment_additional_info'])) {
                    foreach ($item['extension_attributes']['payment_additional_info'] as $info) {
                        $opi = new OrderPaymentInfo;
                        $opi->order_id = $o->id;
                        $opi->key = $info['key'];
                        $opi->value = $info['value'];
                        $opi->save();
                    }
                }


                if (isset($item['extension_attributes']['applied_taxes'])) {
                    foreach ($item['extension_attributes']['applied_taxes'] as $tax) {
                        $at = new OrderAppliedTax;
                        $at->order_id = $o->id;
                        $at->code = $tax['code'];
                        $at->title = $tax['title'];
                        $at->percent = $tax['percent'];
                        $at->amount = $tax['amount'];
                        $at->base_amount = $tax['base_amount'];
                        $at->save();
                    }
                }

                if (isset($item['extension_attributes']['item_applied_taxes'])) {
                    foreach ($item['extension_attributes']['item_applied_taxes'][0]['applied_taxes'] as $tax) {
                        $iat = new OrderAppliedTax;
                        $iat->order_id = $o->id;
                        $iat->code = $tax['code'];
                        $iat->title = $tax['title'];
                        $iat->percent = $tax['percent'];
                        $iat->amount = $tax['amount'];
                        $iat->base_amount = $tax['base_amount'];
                        $iat->save();

                        $oiat = new OrderItemAppliedTax;
                        $oiat->order_id = $o->id;
                        $oiat->applied_tax_id = $iat->id;
                        $oiat->type = $item['extension_attributes']['item_applied_taxes'][0]['type'];
                        $oiat->save();
                    }
                }
            }

            $orders = Order::paginate(20);
            return response()->json($orders, 200);
        } else {
            return response($response->json(), $response->status());
        }
    }

    /**
     * get
     *
     * @return void
     */
    public function get()
    {
        $orders = Order::with(
            'items', 
            'items.options', 
            'billingAddress', 
            'payment', 
            'shipping', 
            'shipping.address', 
            'shipping.total', 
            'shipping.items', 
            'shipping.items.shippingOption', 
            'paymentInfo', 
            'appliedTaxes',
            'itemAppliedTaxes',
            'itemAppliedTaxes.appliedTax'
            )->paginate(20);

        return response()->json($orders, 200);
    }
}
