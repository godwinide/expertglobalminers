var GLOBAL = {
    PhoneValidation: function (e, t) {
        try {
            var charCode = e.which;
            if (charCode === 45) return true;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {

                return false;
            }
            return true;
        }
        catch (err) {
            alert(err.Description);
        }
    },

    getState: function (_this, flag) {
        var _cID = $(_this).val();
        $("#ReferId").removeAttr('readonly');
        if ($('#ReferId').val() == 0 || $('#ReferId').val() == -7 || $('#ReferId').val() == -11 || $('#ReferId').val() == -10 || $('#ReferId').val() == -12 || $('#ReferId').val() == -13 || $('#ReferId').val() == -9) {
            $('#ReferId').val(0);
            if ($('#ReferId').val() == -7 || _cID == 80) {
                $('#ReferId').val(-7);
                $("#ReferId").attr("readonly", "readonly");
            }
            else if ($('#ReferId').val() == -11 || _cID == 44) {
                $('#ReferId').val(-11);
                $("#ReferId").attr("readonly", "readonly");
            }
            else if ($('#ReferId').val() == -10 || _cID == 62) {
                $('#ReferId').val(-10);
                $("#ReferId").attr("readonly", "readonly");
            }
            else if ($('#ReferId').val() == -12 || _cID == 181) {
                $('#ReferId').val(-12);
                $("#ReferId").attr("readonly", "readonly");
            }
            else if ($('#ReferId').val() == -9 || _cID == 90) {
                $('#ReferId').val(-9);
                $("#ReferId").attr("readonly", "readonly");
            }
            else if ($('#ReferId').val() == -13 || _cID == 147) {
                $('#ReferId').val(-13);
                $("#ReferId").attr("readonly", "readonly");
            }
            else {
                $('#ReferId').val(0);
                $("#ReferId").removeAttr('readonly');
            }
        }
        flag = flag > 0 ? flag : 0;
        if (flag > 0) {
            var isd_code = $(_this).find('option:selected').attr("Isd_Id");
            $('#Code').val(isd_code);
        }
        if (flag < 2) {
            $.ajax({
                url: "/Account/GetStateByCountryId",
                data: { CountryId: _cID },
                cache: false,
                success: function (response) {
                    if (response.success) {
                        $('#StateList').html(response.data);
                    }
                    else {
                        alert(response.data);
                    }
                }
            });
        }
    },

    getLeverage: function (_this) {
        var ID = $("#AccountType").val();
        $.ajax({
            url: "/User/GetLeverageByAccountId",
            data: { AccountId: ID },
            cache: false,
            success: function (response) {
                if (response.success) {
                    $('#Leverage').html(response.data);
                }
                else {
                    alert(response.data);
                }
            }

        })
    },

    getBonus: function (_This, CountryId) {        
        debugger;
        _this = $(_This).val();
        if (CountryId == 136) {
            var html = '<option value="2">30% Tradable Bonus</option><option value="3">No Bonus</option>';
            $('#Bonus').html(html);
            if (_this == 6) {
                $('#Bonus').find('option[value="3"]').remove();
            }
            else {
                $('#Bonus').find('option[value="2"]').remove();
            }
        }
        else {
            var html = '<option value="0">--Select Bonus--</option><option value="1">100% Credit Bonus</option><option value="2">30% Tradable Bonus</option><option value="3">No Bonus</option>';
            $('#Bonus').html(html);
            if (_this == 1 || _this == 2 || _this == 3) {
                $('#Bonus').find('option[value="2"]').remove();
            }
            else if (_this == 4 || _this == 5) {
                $('#Bonus').find('option[value="0"]').remove();
                $('#Bonus').find('option[value="1"]').remove();
                $('#Bonus').find('option[value="2"]').remove();
            }
            else if (_this == 6) {
                $('#Bonus').find('option[value="0"]').remove();
                $('#Bonus').find('option[value="1"]').remove();
                $('#Bonus').find('option[value="3"]').remove();
            }

        }

    },

    Enterkey: function (e) {
        if (e.keyCode === 13) {
            Admin.AddNotes();
        }
        return true;
    },

    EnterkeyPartner: function (e) {
        if (e.keyCode === 13) {
            Admin.AddNotesPartner();
        }
        return true;
    },
}
var loadCount = 0;
$(document).on({
    ajaxComplete: function (evt, request, settings) {
        if (settings.url == "/signalr" || settings.url == "/signalr/negotiate" || settings.url == "/signalr/connect" || settings.url.split('?')[0] == "/Default/PrtDemoContestRank" || settings.url.split('?')[0] == "/Default/PrtIndexRank" || settings.url.split('?')[0] == "/DefaultFr/PrtIndexFrRank" || settings.url.split('?')[0] == "/DefaultFr/PrtDemoContestFrRank") { }
        else {
            loadCount--;
            if (loadCount < 1) {
                LoaderFadeOut();
            }
        }
    }
})

$(document).ajaxSend(function (evt, request, settings) {
    if (settings.url == "/signalr" || settings.url == "/signalr/negotiate" || settings.url == "/signalr/connect" || settings.url.split('?')[0] == "/Default/PrtDemoContestRank" || settings.url.split('?')[0] == "/Default/PrtIndexRank" || settings.url.split('?')[0] == "/DefaultFr/PrtIndexFrRank" || settings.url.split('?')[0] == "/DefaultFr/PrtDemoContestFrRank") {
        LoaderFadeOut();
    } else {
        loadCount++;
        LoaderFadeIn();
    }
});


function LoaderFadeIn() {
    //alert('on');
    $('#loading_image').show();
}

function LoaderFadeOut() {
    //alert('off');
    $('#loading_image').hide();
}

function AutoCompleteTextBox(TextBoxId, Id) {
    $(TextBoxId).autocomplete({
        source: function (request, response) {
            $(TextBoxId).attr('readonly', 'readonly');
            $.ajax({
                url: "/Admin/GetCustomers",
                data: "{ 'prefix': '" + request.term + "', 'Flag' : '0'}",
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    $("[id$=" + Id + "]").val(0);
                    $(TextBoxId).removeAttr('readonly');
                    response($.map(data, function (item) {
                        LoaderFadeIn();

                        return { label: item.Email, value: item.Email, id: item.ClientId };
                    }))
                },
                messages: {
                    noResults: "",
                    results: function (count) {
                        return count + (count > 1 ? ' results' : ' result ') + ' found';
                    }
                }
            });
        },
        select: function (e, i) {
            $("[id$=" + Id + "]").val(i.item.id);
            LoaderFadeOut();
        },
        minLength: 3
    });
}

function LoadDataTable(tableID) {
    var table = $(tableID).DataTable({
        "columnDefs": [{
            "defaultContent": "-",
            "targets": "_all"
        }],
        "destroy": true,
        "bFilter": true,
        "bLengthChange": true,
        "bPaginate": true,
        "deferRender": true,
        "scrollX": '100%',
        //"scrollY": 1000,
        "scrollCollapse": true,
        "scroller": true,
        "order": [[0, "desc"]]
    });
    table.columns.adjust().draw();
}

function LoadDataTableHistory(tableID, message) {
    var isShow = $('#ShowButtons').val();
    var buttonCommon = {
        init: function (dt, node, config) {
            var table = dt.table().context[0].nTable;
            if (table) config.title = $(table).data('export-title')
        },
        title: 'default title'
    };
    var columns_no = Number($(tableID).data('export-column'));
    var columns = [];
    var i = 0;
    $(tableID).find('thead th').each(function () {
        //alert($(this).data('hide-column')+ " - "+i)
        if ($(this).data('hide-column') != 1) {
            columns.push(i);
        }
        i++;
    });
    if (isShow == 1) {
        var table = $(tableID).DataTable({
            "destroy": true,
            "bFilter": true,
            "bLengthChange": true,
            "bPaginate": true,
            "deferRender": true,
            "scrollX": '100%',
            //"scrollY": 1000,
            "scrollCollapse": true,
            "scroller": true,
            "order": [[0, "desc"]],
            dom: 'Bfrtip',
            buttons: [
                 'pageLength',

                 $.extend(true, {}, buttonCommon, {
                     extend: 'excelHtml5',
                     messageTop: message,
                     exportOptions: {
                         columns: columns
                     }
                 }),
                     $.extend(true, {}, buttonCommon, {
                         extend: 'pdfHtml5',
                         messageTop: message,
                         exportOptions: {
                             columns: columns
                         }
                     })

            ]
        });
    }
    else {
        var table = $(tableID).DataTable({
            "destroy": true,
            "bFilter": true,
            "bLengthChange": true,
            "bPaginate": true,
            "deferRender": true,
            "scrollX": '100%',
            //"scrollY": 1000,
            "scrollCollapse": true,
            "scroller": true,
            "order": [[0, "desc"]],

        });
    }

    table.columns.adjust().draw();
}

function OpenPopup(message, event) {
    $('#AlertMessage').html(message)
    $("#cloneActionAlert").trigger("click");
    $('#btnCloseAlertPopUp').attr('onclick', event)
}

function CallBackRank() {
    $.ajax({
        url: "/Default/PrtDemoContestRank",
        cache: false,
        success: function (response) {
            $('#divRank').html(response);
        }
    });
}

function CallBackRankFr() {
    $.ajax({
        url: "/DefaultFr/PrtDemoContestFrRank",
        cache: false,
        success: function (response) {
            $('#divRank').html(response);
        }
    });
}

function CallBackRankIndexFr() {
    $.ajax({
        url: "/DefaultFr/PrtIndexFrRank",
        cache: false,
        success: function (response) {
            $('#divRank').html(response);
        }
    });
}

function CallBackRankIndex() {
    $.ajax({
        url: "/Default/PrtIndexRank",
        cache: false,
        success: function (response) {
            $('#divRank').html(response);
        }
    });
}

function CallBackRankPhilippines() {
    $.ajax({
        url: "/Default/PrtPhilippinesContestRanking",
        cache: false,
        success: function (response) {
            $('#divRank').html(response);
        }
    });
}

function CallBackRankThai() {
    $.ajax({
        url: "/Default/PrtThaiContestRanking",
        cache: false,
        success: function (response) {
            $('#divRank').html(response);
        }
    });
}





//function LoadDataTableDashboard(tableID) {
//    var table = $(tableID).DataTable({
//        "columnDefs": [{
//            "defaultContent": "-",
//            "targets": "_all"
//        }],
//        "destroy": true,
//        "bFilter": false,
//        "bLengthChange": false,
//        "bPaginate": false,
//        "deferRender": false,
//        "scrollX": '100%',
//        //"scrollY": 1000,
//        "scrollCollapse": false,
//        "scroller": false,
//        "order": [[3, "desc"]]
//    });
//    table.columns.adjust().draw();
//}

