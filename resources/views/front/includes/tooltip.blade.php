
<!-- Slider Jquery-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- This will override jquery-ui's tooltip, button and use bootstrap's tooltip, button. -->
<script>var bootstrapTooltip = jQuery.fn.tooltip;</script>
<script>var bootstrapButton = jQuery.fn.button;</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>jQuery.fn.tooltip = bootstrapTooltip;</script>
<script>jQuery.fn.button = bootstrapButton;</script>