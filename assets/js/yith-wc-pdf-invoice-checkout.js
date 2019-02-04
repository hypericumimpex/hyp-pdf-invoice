var $ = jQuery;

$(document).ready(function () {

    var billingCountry = $('#billing_country');
    var billingCompany = $('#billing_company');
    var billingReceiverID = $('#billing_receiver_id');
    var billingReceiverPec = $('#billing_receiver_pec');
    var billingReceiverVatNumber = $('#billing_vat_number');
    var billingReceiverVatSSN = $('#billing_vat_ssn');

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
    billingReceiverVatNumber.on('input', function () {
        validateFields();
    });

    if( ywpi_checkout.is_ssn_mandatory != 'yes' ){
        billingReceiverVatSSN.on('input', function () {
            validateFields();
        });
    }


    billingCountry.on('change', function () {
        validateFields();
    });
});


var validateFields = function(){

    var billingCountry = $('#billing_country');
    var billingCompany = $('#billing_company');
    var billingReceiverID = $('#billing_receiver_id');
    var billingReceiverPec = $('#billing_receiver_pec');
    var billingReceiverVatNumber = $('#billing_vat_number');
    var billingReceiverVatSSN = $('#billing_vat_ssn');

    if ( billingCompany.val() != '') {

        if( billingCountry.val() == 'IT' ){

            billingReceiverID.closest('.form-row').show();
            billingReceiverPec.closest('.form-row').show();

            if( billingReceiverID.val() != '' && billingReceiverPec.val() == '' ){
                setFieldAsNotRequired( billingReceiverPec );
                billingReceiverID.closest('.form-row').find('.optional').remove();
            }else if( billingReceiverID.val() == '' && billingReceiverPec.val() != '' ){
                setFieldAsNotRequired( billingReceiverID );
                billingReceiverPec.closest('.form-row').find('.optional').remove();

            }else if( billingReceiverID.val() == '' && billingReceiverPec.val() == '' ){
                setFieldAsRequired( billingReceiverID );
                setFieldAsRequired( billingReceiverPec );
            }

            if( ywpi_checkout.is_vat_mandatory != 'yes' ){
                setFieldAsRequired( billingReceiverVatNumber );
            }

            if( ywpi_checkout.is_ssn_mandatory != 'yes' ){
                setFieldAsNotRequired( billingReceiverVatSSN );
            }


        }else{

            if( ywpi_checkout.is_vat_mandatory != 'yes' ){
                setFieldAsNotRequired( billingReceiverVatNumber );
            }

            setFieldAsNotRequired( billingReceiverID, 'no' );
            setFieldAsNotRequired( billingReceiverPec, 'no' );
        }


    }else{

        setFieldAsNotRequired( billingReceiverID, 'no' );
        setFieldAsNotRequired( billingReceiverPec, 'no' );

        if( ywpi_checkout.is_vat_mandatory != 'yes' ){
            setFieldAsNotRequired( billingReceiverVatNumber, 'no' );
        }


        if( ywpi_checkout.is_ssn_mandatory != 'yes' ){
            if( billingCountry.val() == 'IT' ){
                setFieldAsRequired( billingReceiverVatSSN );
            }else{
                setFieldAsNotRequired( billingReceiverVatSSN );
            }
        }


    }


};



var setFieldAsRequired = function( field ){

    var requiredHtml = '<abbr class="required" title="required">*</abbr>';
    if( field.closest('.form-row').find('.optional').length != 0){
        field.closest('.form-row').find('.optional').remove();
        field.closest('.form-row').find('label').append(requiredHtml);
    }
    field.closest('.form-row').show();
    if( field.val() == '' ){
       
        field.closest('.form-row').addClass('validate-required woocommerce-invalid woocommerce-invalid-required-field');
    }

};

var setFieldAsNotRequired = function( field, $show = 'yes' ){

    var optionalHtml = '<span class="optional">(optional)</span>';

    if( field.closest('.form-row').find('.optional').length == 0){
        field.closest('.form-row').find('abbr').remove();
        field.closest('.form-row').find('label').append(optionalHtml);
    }

    field.closest('.form-row').removeClass('validate-required woocommerce-invalid woocommerce-invalid-required-field');
    if( $show == 'no' ){
        field.closest('.form-row').removeClass('validate-required woocommerce-invalid woocommerce-invalid-required-field').hide();
    }
};

