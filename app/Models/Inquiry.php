<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Inquiry extends Model
{

    protected $connection = 'oracle';
    protected $table = 'ipc.ipc_sc_inquiries';
    protected $primaryKey = 'id';
    protected $fillable = ['registered_owner', 'contact_person', 'contact_number', 'email_address', 'preferred_servicing_dealer', 'cs_no'];

    public function getPendingEmail(){
        $sql = "SELECT inquiry.id,
                        inquiry.registered_owner,
                        inquiry.contact_person,
                        inquiry.contact_number,
                        inquiry.email_address,
                        inquiry.cs_no,
                        inquiry.date_sent,
                        dlr.account_name,
                        dlr.dealer_name,
                        dlr_crt.email dealer_crt_email,
                        traviz.engine_no,
                        traviz.vin,
                        cust.party_name || ' - ' || cust.account_name selling_dealer
                FROM ipc.ipc_sc_inquiries inquiry
                    LEFT JOIN ipc_portal.dealers dlr
                        ON inquiry.preferred_servicing_dealer = dlr.id
                    LEFT JOIN ipc.ipc_sc_dealer_crt_emails dlr_crt
                        ON dlr_crt.dealer_id = dlr.id
                    LEFT JOIN  ipc.ipc_sc_traviz traviz
                        ON traviz.cs_no = inquiry.cs_no
                    INNER JOIN ra_customer_trx_all rcta
                        ON rcta.attribute3 = traviz.cs_no
                    INNER JOIN ipc_dms.oracle_customers_v cust
                        ON cust.site_use_id = rcta.bill_to_site_use_id
                    LEFT JOIN ipc_ar_invoices_with_cm cm
                        ON rcta.customer_trx_id = cm.orig_trx_id
                WHERE inquiry.date_sent IS NULL";
        $query = DB::select($sql);
        return $query;
    }

    public function get()
    {
        $sql = "SELECT inquiry.id,
                        inquiry.registered_owner,
                        inquiry.contact_person,
                        inquiry.contact_number,
                        inquiry.email_address,
                        inquiry.cs_no,
                        traviz.engine_no,
                        traviz.vin,
                        dlr.account_name preferred_servicing_dealer,
                        cust.account_name selling_dealer,
                        inquiry.receiving_manner,
                        inquiry.others,
                        to_char(inquiry.completion_date,'YYYY-MM-DD') completion_date,
                        to_char(inquiry.completion_date,'MM/DD/YYYY') completion_date_display 
                FROM ipc.ipc_sc_inquiries inquiry
                    LEFT JOIN ipc.ipc_sc_traviz traviz
                        ON inquiry.cs_no = traviz.cs_no
                    LEFT JOIN ipc_portal.dealers dlr
                        ON dlr.id = inquiry.preferred_servicing_dealer
                    INNER JOIN ra_customer_trx_all rcta
                        ON rcta.attribute3 = traviz.cs_no
                    INNER JOIN ipc_dms.oracle_customers_v cust
                        ON cust.site_use_id = rcta.bill_to_site_use_id
                    LEFT JOIN ipc_ar_invoices_with_cm cm
                        ON rcta.customer_trx_id = cm.orig_trx_id";
        $query = DB::select($sql);
        return $query;
    }

    public function getByDealer($cust_account_id)
    {
        $sql = "SELECT inquiry.id,
                        inquiry.registered_owner,
                        inquiry.contact_person,
                        inquiry.contact_number,
                        inquiry.email_address,
                        inquiry.cs_no,
                        traviz.engine_no,
                        traviz.vin,
                        dlr.account_name preferred_servicing_dealer,
                        cust.account_name selling_dealer,
                        inquiry.receiving_manner,
                        inquiry.others,
                        to_char(inquiry.completion_date,'YYYY-MM-DD') completion_date,
                        to_char(inquiry.completion_date,'MM/DD/YYYY') completion_date_display 
                FROM ipc.ipc_sc_inquiries inquiry
                    LEFT JOIN ipc.ipc_sc_traviz traviz
                        ON inquiry.cs_no = traviz.cs_no
                    LEFT JOIN ipc_portal.dealers dlr
                        ON dlr.id = inquiry.preferred_servicing_dealer
                    INNER JOIN ra_customer_trx_all rcta
                        ON rcta.attribute3 = traviz.cs_no
                    INNER JOIN ipc_dms.oracle_customers_v cust
                        ON cust.site_use_id = rcta.bill_to_site_use_id
                    LEFT JOIN ipc_ar_invoices_with_cm cm
                        ON rcta.customer_trx_id = cm.orig_trx_id
                WHERE dlr.cust_account_id = :cust_account_id";
        $query = DB::select($sql, ['cust_account_id' => $cust_account_id]);
        return $query;
    }

}
