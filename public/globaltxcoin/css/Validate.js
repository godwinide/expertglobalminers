function ValidateInteger(e, t) {  // Example :  .. return GLOBAL.AllowNoOnly(event,this)
    try {
        var charCode = e.which;
        if (charCode == 46) {
            if ($(t).val().indexOf(".") === -1) return true;
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    catch (err) {
        alert(err.Description);
    }
}
function ValidateDecimal(e, t, suffix) {  // Example :  .. return GLOBAL.AllowNoOnly(event,this)        
    try {
        var charCode = e.which;
        if (charCode == 46) {
            if ($(t).val().indexOf(".") === -1) return true;
        }
        else {
            if ($(t).val().indexOf(".") !== -1) {
                if ($(t).val().split('.')[1].length == suffix && charCode != 8)
                    return false;
            }
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    catch (err) {
        alert(err.Description);
    }
}

function integerNumberValidateOnBlur(obj) {
    var v = $(obj).val().trim();
    if (v == '')
    { $(obj).val(0); }
    else if (isNaN(v)) {
        $(obj).val(0);
    }
    else if (v < 0) {
        //$(obj).val(0);
        $(obj).val(Number(v) + (2 * Math.abs(Number(v))));
    }
    else {
        $(obj).val(parseInt(v));
    }
}

function numberValidateOnBlur(obj) {
    var v = $(obj).val().trim();
    if (v == '')
    { $(obj).val(0); }
    else if (isNaN(v)) {
        $(obj).val(0);
    }
    else if (v < 0) {
        //$(obj).val(0);
        $(obj).val(Number(v) + (2 * Math.abs(Number(v))));
    }
}

function numberValidateOnFocus(obj) {
    var v = $(obj).val().trim();
    if (v == '0') {
        $(obj).val('');
    }
}

function FormatAmount(_this) {
    var amount = $.trim($(_this).val());
    if (!$.isNumeric(amount)) {
        return;
    }
    else {
        $(_this).val(parseFloat(amount).toFixed(2));
    }
}

////CheckMultiple Emailid's
//function validateEmail(field) {
//    var regex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
//    return (regex.test((field))) ? true : false;
//}

function ValidateEmail(email) {
    //alert(email);
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    // alert(expr.test(email));
    return expr.test(email);
}

function RemoveValidations(_this, tag) {
    if (tag == 'input' && $.trim($(_this).val()) == "") {
    }
    else if (tag == 'select' && ($(_this).val() == "0" || $(_this).val() == "-1")) {
    }
    else if (tag == 'textarea' && $.trim($(_this).val()) == "") {
    }
    else {
        $(_this).removeClass("error")
        $(_this).css("border", "")
    }
}
function RemoveAllValidations()
{
    $("input").each(function () {
        if ($(this).attr("isrequired") == "true") {
            $(this).removeClass("error")
            $(this).css("border", "")
        }
    });
    $("select").each(function () {
        if ($(this).attr("isrequired") == "true") {
            $(this).removeClass("error")
            $(this).css("border", "")
        }
    });
    $("textarea").each(function () {
        if ($(this).attr("isrequired") == "true") {
            $(this).removeClass("error")
            $(this).css("border", "")
        }
    });
}
//----*****Validations for all inputs,textareas,dropdown****--------
function Validations(IsCustom, container, errormsg_id) {
    var IsRequired = false;
    var IsEmail = false;
    var bordertype = IsCustom ? "border-bottom" : "border";
    var borderCss = IsCustom ? "2px solid red" : "1px solid red";
    var error = true;
    var pass = "";
    //alert(error+"-1");
    $('#' + container).find("input").each(function () {
        if ($(this).attr("type") == "text" || $(this).attr("type") == "password" || $(this).attr("type") == "email" || $(this).attr("type") == "checkbox" || $(this).attr("type") == "file") {
            if ($(this).attr("isrequired") == "true") {
                $(this).removeClass("error");
                $(this).css(bordertype, "");
                if ($(this).attr("validationType") == "text") {
                    //alert(error + "-2");
                    if ($(this).attr("type") == "checkbox") {
                        if ($(this).is(':checked') == false) {
                            alert('Terms and condition acceptance is required.');
                            $(this).addClass("error");
                            $(this).css(bordertype, borderCss);
                            IsRequired = true;
                            error = false;
                        }
                    }
                    else if ($(this).attr("type") == "select") {
                        if ($(this).val() == "0" || $(this).val() == "-1") {
                            $(this).css(bordertype, borderCss);
                            $(this).addClass("error");
                            IsRequired = true;
                            error = false;
                        }
                    }
                    else {
                        if ($.trim($(this).val()) == "") {
                            $(this).css(bordertype, borderCss);
                            $(this).addClass("error");
                            IsRequired = true;
                            error = false;
                        }
                    }
                }
                if ($(this).attr("validationType") == "email") {
                    if (!ValidateEmail($(this).val())) {
                        $(this).addClass("error");
                        $(this).css(bordertype, borderCss);
                        IsEmail = true;
                        error = false;
                        //alert(error + "-3.1");
                    }
                    //alert(error + "-3");
                }
                if ($(this).attr("password") !== undefined) {
                    if ($(this).attr("password").toString().toLowerCase() == "true") {
                        if ($(this).val() != "") {
                            pass = $(this).val();
                        }
                    }
                }
                if ($(this).attr("confirmpassword") !== undefined) {
                    if ($(this).attr("confirmpassword").toString().toLowerCase() == "true") {
                        var confrmPass = $(this).val();
                        if (pass != confrmPass) {
                            alert("Password must match.");
                            $(this).val("");
                            error = false;
                        }
                    }
                }
            }
            //alert($(this).attr('id') + "-" + error);
        }

    });
    $('#' + container).find("select").each(function () {
        $(this).removeClass("error");
        $(this).css(bordertype, "");
        if ($(this).attr("isrequired") == "true") {
            if ($(this).val() == "0" || $(this).val() == "-1" || $('#dobday').val() == "" || $('#dobmonth').val() == "" || $('#dobyear').val() == "") {
                $(this).css(bordertype, borderCss);
                $(this).addClass("error");
                IsRequired = true;
                error = false;
            }
        }
    });
    $('#' + container).find("textarea").each(function () {
        $(this).removeClass("error");
        $(this).css(bordertype, "");
        if ($(this).attr("isrequired") == "true") {
            if ($.trim($(this).val()) == "") {
                $(this).css(bordertype, borderCss);
                $(this).addClass("error");
                IsRequired = true;
                error = false;
            }
        }
    });
    if (IsRequired)
        $('#' + errormsg_id).html("Please fill in the all highlighted fields.");
    else if (IsEmail)
        $('#' + errormsg_id).html("Please enter correct email format.");
        
    else if (errormsg_id != undefined && errormsg_id != "" && error == false) {
        $('#' + errormsg_id).html("Please fill in the all highlighted fields.");
    }
    return error;
}
