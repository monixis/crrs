<?php?><link rel="stylesheet" type="text/css" href="./styles/main.css" /><link rel="stylesheet" type="text/css" href="./styles/qtip.css" /><link rel="stylesheet" href="./styles/jquery-ui.css" type="text/css" /><script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script><script type="text/javascript" src="./js/jquery-ui.js"></script><script type="text/javascript" src="./js/qtip.js"></script><script type="text/javascript" src="./js/dashboard.js"></script><script>    $(document).ready(function() {        $("#dateStart").datepicker({            minDate : "+0"        });    })</script><script>    // Check browser support        // Store        localStorage.setItem("tentative", 0);        // Retrieve</script><script>    $(document).ready(function(){        $('img.tooltip').each(function() {            $(this).qtip({                content: {                    text: function(event, api) {                        $.ajax({                                url: api.elements.target.attr('id') // Use href attribute as URL                            })                            .then(function(content) {                                // Set the tooltip content upon successful retrieval                                api.set('content.text', content);                            }, function(xhr, status, error) {                                // Upon failure... set the tooltip content to error                                api.set('content.text', status + ': ' + error);                            });                        return 'Loading...'; // Set some initial text                    }                },                position: {                    viewport: $(window)                },                style: 'qtip-wiki'            });        });    });</script><div style="width: 750px;">    <div id="detailsType">        <div id="color" style="width: 60px; height: 640px; float:left; background: green; ">        </div>        <div style="float:right; width:690px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">            <p>Reservation Conflict</p>            <h5>This slot is already reserved/ Tentatively reserved.</h5>        </div>    </div></div>