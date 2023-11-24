<style>
    .center {
        margin-left: auto;
        margin-right: auto;
    }
</style>
<html>
    <table class="center">
        <tr>
            <th colspan="2"><h3>Supplier Inquiry</h3></th>
        </tr>
        <tr>
            <td>Company Name</td>
            <td>{{ isset($inquiryForm['company_name']) ? $inquiryForm['company_name'] : '' }}</td>
        </tr>
        <tr>
            <td>Brand Name</td>
            <td>{{ isset($inquiryForm['brand_name']) ? $inquiryForm['brand_name'] : '' }}</td>
        </tr>
        <tr>
            <td>Legal Business Name</td>
            <td>{{ isset($inquiryForm['business_name']) ? $inquiryForm['business_name'] : '' }}</td>
        </tr>
        <tr>
            <td>Contact Name</td>
            <td>{{ isset($inquiryForm['contact_name']) ? $inquiryForm['contact_name'] : '' }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ isset($inquiryForm['email']) ? $inquiryForm['email'] : '' }}</td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>{{ isset($inquiryForm['phone_number']) ? $inquiryForm['phone_number'] : '' }}</td>
        </tr>
        <tr>
            <td>Country</td>
            <td>{{ isset($inquiryForm['country']) ? $inquiryForm['country'] : '' }}</td>
        </tr>
        <tr>
            <td>City</td>
            <td>{{ isset($inquiryForm['city']) ? $inquiryForm['city'] : '' }}</td>
        </tr>
        <tr>
            <td>Sub Distric</td>
            <td>{{ isset($inquiryForm['sub_distric']) ? $inquiryForm['sub_distric'] : '' }}</td>
        </tr>
        <tr>
            <td>Additions Details</td>
            <td>{{ isset($inquiryForm['additional_detail']) ? $inquiryForm['additional_detail'] : '' }}</td>
        </tr>
    </table>
</html>