$(".genfax").click(function() {  getFaxContent(); });
    function getFaxContent() {
        top.restoreSession();
        document.report_form.fax.value = 1;
        let url = '../report/custom_report.php';
        let wait = '<span id="wait"><?php echo xlt("Building Document .. ");?><i class="fa fa-cog fa-spin fa-2x"></i></span>';
        $("#waitplace").append(wait);
        $.ajax({
            type: "POST",
            url: url,
            data: $("#report_form").serialize(),
            success: function (content) {
              //alert(content);
                $("#wait").remove();
                document.report_form.fax.value = 0;
                let btnClose = "Cancel";
                let title = "Send To";
                let url = top.webroot_url + '/interface/customized/ringcentral/rc_fax/contact.php?isContent=0&file='+encodeURIComponent(content.trim());
                console.log(url);
                dlgopen(url, 'faxto', 'modal-sm', 550, '', title, {
                    buttons: [
                        {text: btnClose, close: true, style: 'default btn-xs'}
                    ],
                    onClosed: 'cleanUp'
                });
                return false;
            }
        });

        return false;
    }