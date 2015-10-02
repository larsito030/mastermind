

initial_array = ['red','blue','yellow','green','purple'];

function colors_intersection(el){
		return array_rand.indexOf(el) !== -1;
		}

function equal_position(el){
		return colors_match.indexOf(el) === array_rand.indexOf(el);
		}

function get_matching_hint_html(){
		var bl = black - white;					
		for(var i=0;i<bl;i++){
			$('.results:eq('+ prev +')').find('li:eq('+ i +')').addClass('black');
		}	
		for(var i=bl;i<(bl+white);i++){
			$('.results:eq('+ prev +')').find('li:eq('+ i +')').addClass('white');
			}
		}

function check_if_solved() {
	if(white === 4) {
			success_msg();
			}
		}

function fail_message() {
	if(white !== 4 && no === rows) {
			$("<span class='fail'>Sorry, but you didn't make it. Just give it another try!</span>").appendTo('body').fadeOut(3000);
			}
		}

function success_msg() {
		var x = no > 1 ? "s" : "";
			$("<div id='success'>Congratulations! It took you "+num+" attempt"+x+"</div>").appendTo('body').fadeOut(3000);
		}

function shuffle(initial_array) {
  var currentIndex = initial_array.length, temporaryValue, randomIndex ;
  while (0 !== currentIndex) {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;
    temporaryValue = initial_array[currentIndex];
    initial_array[currentIndex] = initial_array[randomIndex];
    initial_array[randomIndex] = temporaryValue;
  }
  return initial_array;
}


