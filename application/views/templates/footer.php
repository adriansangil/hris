		</div>
<footer class="bs-footer">
		<div class="container">
			<nav class="navbar navbar-inverse" role="navigation">
				<p class="navbar-text navbar-center">ICI HRIS <?php echo date("Y"); ?></p>
			</nav>
		  <script type="text/javascript" src=<?php echo base_url().'bootstrap/js/jquery-1.10.2.min.js' ?>></script>
			<script type="text/javascript" src=<?php echo base_url().'bootstrap/js/bootstrap.js' ?>></script>
			<script type="text/javascript" src=<?php echo base_url().'bootstrap/js/bootstrap-datetimepicker.min.js' ?>></script>
			<script type="text/javascript">
				$(function(){
					$("a").popover();
				});
				$('[hrispopover="popover"]').popover({trigger: 'hover','placement': 'bottom', html: 'true', delay: { show: 1000, hide: 100 },
  					template: '<div class="popover special-class" style="width: 170px;"><div class="arrow"></div><div class="popover-inner" ><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>'});
				$('[hristooltip="tooltip"]').tooltip({'placement': 'auto', delay: { show: 250, hide: 100 }});
				$(function() {
    				$('#datetimepickeradd').datetimepicker({
      					language: 'pt-BR',
      					pickTime: false
    				});
     			});
    			$('#datetimepickeredit').datetimepicker({
      				language: 'pt-BR',
      				pickTime: false
      			});
      			$('.datetimepickeredit').datetimepicker({
      				language: 'pt-BR',
      				pickTime: false
      			});
			</script>	
      <script type="text/javascript">
$(function(){
    var template = $('#field-row-container #field-row-0:first').clone();
    var fieldRowCount = 0;
window.addForm = function () {
    fieldRowCount++;
    var newFieldRow = template.clone().find(':input').each(function(){
        var newId = this.id.substring(0, this.id.length - 3) + "[" + fieldRowCount + "]";

        $(this).prev().attr('for', newId); // update label for
        this.id = newId;
        this.name = newId;// update id and name (assume the same)
        $(this).closest('.field-row').addClass('new-row');
    }).end()
        .attr('id', 'field-row-' + fieldRowCount)
        .appendTo('#field-row-container');
        $('.datetimepickeredit').datetimepicker({
      				language: 'pt-BR',
      				pickTime: false
      			});
}
$('.add-field-row').click(addForm);
$('.delete-field-row').on('click', function(e) {
  e.preventDefault();
    $('.clonedinput').last().remove();
    fieldRowCount = fieldRowCount -1;
});
});

</script>		
		</div>
		</footer>
	</body>
</html>
