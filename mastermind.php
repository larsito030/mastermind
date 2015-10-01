

<?php include("functions.php");; 
	
	if(isset($_POST['new'])) {
		get_random_sample();
	}
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
		<script text="javascript">


			array = [];
			$(document).ready(function() {
				//array_rand = <?php echo json_encode($_SESSION['random']);?>;
				//console.log(array_rand);

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
				console.log(y_pos);
				console.log('Offset left:'+offset.left);
				console.log('width: ' + $(row_active).css('width'));
				console.log('X Pos:'+x_pos);
				console.log(row_active);

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
				
				//$(ok_button).css({top: 200, left: 200, position:'absolute'});
				//$(ok_button).css({'width':'100px',
				//				'height':'100px'});
				//$(ok_button).css('background','blue');
				//$('body').append(ok_button);
				
				//$('body').append('<p>Test</p>');
				$(color_field).on('click', function(){
					color = $(this).find('span').attr('id');
					css_color = $(this).find('span').css('background');
					console.log(css_color);
					console.log('color: '+color);
				});
				$('#active').on('click','li', function(){
						console.log('clicked');
							var index_guess = $(this).index();
							array[index_guess] = color;
							$(this).find('span').css('background', css_color);
							console.log(array);
				
				});

				array_rand = <?php echo json_encode($_SESSION['random']);?>;
				
				function colors_intersection(el){
					return array_rand.indexOf(el) !== -1;
					}

				function equal_position(el){
					return colors_match.indexOf(el) === array_rand.indexOf(el);
				}

				function get_matching_hint_html(){
					var bl = black - white;
					console.log('test: ' + bl);
					//$('.results').find('li:eq('+ 1 +')').addClass('black');
					
					for(var i=0;i<bl;i++){
						$('.results:eq('+ prev +')').find('li:eq('+ i +')').addClass('black');
					}	
					for(var i=bl;i<(bl+white);i++){
						$('.results:eq('+ prev +')').find('li:eq('+ i +')').addClass('white');
					}
					console.log(prev);
				}

				function check_if_solved() {
					if(white === 4) {
						success_msg();
					}
				}

				function success_msg() {
					console.log('gewonnen');
					var x = no > 1 ? "e" : "";
					$('body').append("<div id='success'>Herzlichen Glückwunsch! Sie haben "+num+" Versuch"+x+" benötigt<button id='rm_msg'>OK</button></div>");
					//$('body').append("<p>Herzlichen Glückwunsch!</p>");
				}

				$('body').on('click','#ok', function(){
						$('#active').off();
						colors_match = array.filter(colors_intersection);
						black = colors_match.length;
						var total_match = colors_match.filter(equal_position);
						white = total_match.length;
						prev = no.toString();
						console.log("Black: " + black);
						console.log("White: " + white);
						no++;
						num = no.toString();
						$('.row').removeAttr('id');
						row_active = "";
						row_active = $('.row:eq('+ num +')');
						$(row_active).attr('id','active');
						//$('.row').css('background','gray');
						console.log("row active: " + no + " sting: " + num);
						get_matching_hint_html();
						check_if_solved();
						y_pos = y_pos + parseInt($('.row').css('height'));
						$('#ok').css('top', y_pos);
						console.log(y_pos);
						$(row_active).on('click','li', function(){
							console.log('clicked');
							var index_guess = $(this).index();
							array[index_guess] = color;
							$(this).find('span').css('background', css_color);
							console.log(array);
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