

<?php include("functions.php");; 
	
	if(isset($_POST['new'])) {
		get_random_sample();
	}
	//print_r($_SESSION['random']);
	//print_r($_POST['rows']);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Title of the document</title>
		<meta charset="UTF-8"/>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
		<meta http-equiv="Pragma" content="no-cache"/>
		<meta http-equiv="Expires" content="0"/>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/Superhirn/app.css" type="text/css"/>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="app.js"></script>
		<script text="javascript">


			
			$(document).ready(function() {
				array = [];
				rows = ($('.row').find('li').length)/4;
				var color_field = $('.color_picker>ul>li');
				var colors = $('.color_picker>ul');
				no = 0;
				num = no.toString();
				prev = "";
				row_active = $('.row:eq('+ num +')');
				$(row_active).attr('id','active');
				array = [];
				for(i=0;i<4;i++){
					array[i] = 'color';
				}
				black = "";
				white ="";
				color = "";
				css_color = "";
				colors_match = "";
				offset = row_active.offset();
				y_pos = offset.top + 16;
				x_pos = offset.left + parseInt($(row_active).css('width')) + 10;
				$( window ).resize(function() {
  					y_pos = offset.top + 16;
					x_pos = offset.left + parseInt($(row_active).css('width')) + 10;
				});
				var ok_button = "<button name=\"ok\" id=\"check\" value=\"OK\">OK</button>";

				$("<button></button>", {
    						text: 'OK',
    						id: 'ok'
							}).appendTo("body");
				$('#ok').css({'position':'absolute',
							  'top': y_pos, 'left': x_pos, 
							  'width':'60px', 
							  'height':'50px',
							  'font-size':'1.5rem',
							  'font-weight':'600',
							  'border-radius':'10px',
							   'font-family':'Helvetica',
								'background':'rgb(46, 204, 113)',
								'color':'white'});

				$(color_field).on('click', function(){
					color = $(this).find('span').attr('id');
					css_color = $(this).find('span').css('background');
				});
				$('#active').on('click','li', function(){
							var index_guess = $(this).index();
							array[index_guess] = color;
							$(this).find('span').css('background', css_color);
				
				});

				//array_rand = <?php echo json_encode($_SESSION['random']);?>;
				array_rand = shuffle(initial_array);
				console.log("array_rand: "+array_rand);
				
				
				$('body').on('click','#ok', function(){
						$('#active').off();
						colors_match = array.filter(colors_intersection);
						black = colors_match.length;
						var total_match = colors_match.filter(equal_position);
						white = total_match.length;
						prev = no.toString();
						no++;
						num = no.toString();
						$('.row').removeAttr('id');
						row_active = "";
						row_active = $('.row:eq('+ num +')');
						$(row_active).attr('id','active');
						get_matching_hint_html();
						check_if_solved();
						fail_message();
						y_pos = y_pos + parseInt($('.row').css('height'));
						$('#ok').css('top', y_pos);
						$(row_active).on('click','li', function(){
							var index_guess = $(this).index();
							array[index_guess] = color;
							$(this).find('span').css('background', css_color);

				});
	
				});

			});
		</script>
	</head>

<body>
	<?php include("../navbar.php"); ?>
	<div class="main_wrapper">
		<form action="mastermind.php" method="post">
			<input type="submit" name="new" value="new game"></input>
			<select name="rows" value="number of rows">
					<option>6 rows</option>
					<option selected="selected">8 rows</option>
					<option>10 rows</option>
			</select>
		</form>
		<div class="color_picker">
			<ul>
				<li><span class="circular red" id="red"></span></li>
				<li><span class="circular blue" id="blue"></span></li>
				<li><span class="circular green" id="green"></span></li>
				<li><span class="circular purple" id="purple"></span></li>
				<li><span class="circular yellow" id="yellow"></span></li>
			</ul>
		</div>
		<div id="inner_wrapper">
			<div id="numbers_column">
				<ul>
				<?php get_row_numbers(); ?>
				</ul>
			</div>
			<div id="results_column">
				<ul>
				<?php get_hint_column(); ?>
				</ul>
			</div>
			<div class="game_grid">
				<?php get_grid_html(); ?>
			</div>
		
		</div>
	</div>
</body>

</html>