let GlobalClass = {};
// jquery ui DIALOGS
GlobalClass.subTabIndicator = function () {
    //indicates which button is clicked
    //the one that is clicked changes color, and all the other stay the same
    $('body').on("click", ".standardbutton", function () {
        $(".standardbutton").removeClass("standardbutton-click");
        $(this).addClass("standardbutton-click");
    });
};
GlobalClass.subTabReportIndicator = function () {
    //indicates which report is clicked
    //the one that is clicked changes color, and all the other stay the same
    $("body").on("click", ".standardbutton-report", function () {
        $(".standardbutton-report").removeClass("standardbutton-report-click");
        $(this).addClass("standardbutton-report-click");
    });

};
GlobalClass.openDialog = function (request_type= 'GET', path, data, height, width, title) {
    GlobalClass.subTabReportIndicator();
    GlobalClass.subTabIndicator();

    $('#loading').css({'display': 'block'});
    $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    ajaxObj=$.ajax({
        type: request_type,
        url: path,
        data: {get_data:data}
    });
    ajaxObj.done(function (msg) {
        let dHeight=  'auto';
        let randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
        let uniqid = randLetter + Date.now();
        let newDiv = $("<div class='new-div'></div>");

        newDiv.attr('id', uniqid);
        newDiv.attr('title', title);
        $('#' + uniqid).dialog();

        let str = typeof(height);
        let heightChar='';
        if(str == 'string'){
            heightChar = height.substr(height.length - 1);
        }

        if(heightChar=='%'){
            console.log("VO IF");
            let heighnum = height.length;
            if(heighnum==4){
                let heightper = height.substr(0,3)/100;
                let wHeight = $(window).height();
                dHeight = wHeight * heightper;
            }
            else if(heighnum==3){
                let heightper = height.substr(0,2)/100;
                let wHeight = $(window).height();
                dHeight = wHeight * heightper;
            }
            else if(heighnum==2){
                let heightper = height.substr(0,1)/100;
                let wHeight = $(window).height();
                dHeight = wHeight * heightper;
            }
        }
        else{
            dHeight = height;
        }

        $('#dialog-holder').append(newDiv);
        $('#' + uniqid).html(msg);
        $('#' + uniqid).dialog({
            height: dHeight,
            width: width,
            position: { my: "center", at: "center top", of: window },
            modal: true,
            resizable: false,
            close: function () {
                saveDialogData(uniqid);
                $('div[aria-describedby="' + uniqid + '"]').remove();
                $('#' + uniqid).remove();
            }
        });
        $('#loading').css({'display': 'none'});
    });
};
function saveDialogData(uniqid) {
    $('#' + uniqid).find('button.save-button').click();
}
function get_dialog_unique_id(elementid) {
    let dialogobject = $('#' + elementid).parent().closest("div[aria-describedby]");
    return dialogobject.attr("aria-describedby");
}
function remove_dialog(elementid) {
    let dialogid = get_dialog_unique_id(elementid);
    $('div[aria-describedby="' + dialogid + '"]').remove();
    $('#' + dialogid).remove();
}

$('body').on('click', '.edit-user-request', function(e){
    e.stopPropagation();
    let path= $(this).data('path');
    GlobalClass.openDialog('GET', path, '', 'auto', '60%', 'Edit  Holiday Request')
});
$('body').on('click', '.list_user_requests tr', function(e){
    e.stopPropagation();
    let path= $(this).data('path');
    GlobalClass.openDialog('GET', path, '', 'auto', '60%', 'Show Holiday Request');
});
// DIALOGS END