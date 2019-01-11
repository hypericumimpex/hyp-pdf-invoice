var $ = jQuery;

$(document).ready(function () {

    var billingCompany = $('#billing_company');
    var billingReceiverID = $('#billing_receiver_id');
    var billingReceiverPec = $('#billing_receiver_pec');

    validateFields();

    billingCompany.on('input', function () {
        validateFields();
    });
    billingReceiverID.on('input', function () {
        validateFields();
    });
    billingReceiverPec.on('input', function () {
        validateFields();
    });
});


var validateFields = function(){

    var billingCompany = $('#billing_company');
    var billingReceiverID = $('#billing_receiver_id');
    var billingReceiverPec = $('#billing_receiver_pec');

    if ( billingCompany.val() != '') {

        setFieldAsRequired( billingReceiverID );
        setFieldAsRequired( billingReceiverPec );

    }else{
        setFieldAsNotRequired( billingReceiverID );
        setFieldAsNotRequired( billingReceiverPec );
    }
};



var setFieldAsRequired = function( field ){

    var requiredHtml = '<abbr class="required" title="required">*</abbr>';
    if( field.closest('.form-row').find('.optional').length != 0){
        field.closest('.form-row').find('.optional').remove();
        field.closest('.form-row').find('label').append(requiredHtml);
    }
    if( field.val() == '' ){

        field.closest('.form-row').addClass('validate-required woocommerce-invalid woocommerce-invalid-required-field');
    }
};

var setFieldAsNotRequired = function( field ){
    var optionalHtml = '<span class="optional">(optional)</span>';

    if( field.closest('.form-row').find('.optional').length == 0){
        field.closest('.form-row').find('abbr').remove();
        field.closest('.form-row').find('label').append(optionalHtml);
    }

    if( field.val() != '' ){
        field.closest('.form-row').removeClass('validate-required woocommerce-invalid woocommerce-invalid-required-field');
    }
};

