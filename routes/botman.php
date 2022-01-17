<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Habari(.*)', function ($bot) {
	$bot->reply('Mzuri sana,naitwa Ali ');
	$bot->reply('Karibu katika gumzo hili');
	$bot->reply('Niulize kuhusu Korona');
});
$botman->hears('Mambo(.*)', function ($bot) {
	$bot->reply('Poa, naitwa Ali');
        $bot->reply('Karibu katika gumzo hili');
	$bot->reply('Niulize kuhusu Korona');
});	


$botman->hears('Oyaah(.*)', function ($bot) {
	$bot->reply('Oyaah, naitwa Ali');
        $bot->reply('Karibu katika gumzo hili');
	$bot->reply('Niulize kuhusu Korona');
});	

$botman->hears('Niaje(.*)', function ($bot) {
	$bot->reply('Fiti sana, naitwa Ali');
        $bot->reply('Karibu katika gumzo hili');
	$bot->reply('Niulize kuhusu Korona');


});
$botman->hears('(.*)Korona ni nini?|covid19 ni nini?|ugonjwa wa corona ni nini?|ugonjwa wa korona ni nini?|corona ni nini?|nina corona|nina korona|corona|korona', function ($bot) {
 	$bot->reply('Ugonjwa wa virusi vya Korona (COVID-19) ni ugonjwa wa kuambukiza unaosababishwa na virusi vya korona ambavyo vilig         unduliwa hivi majuzi.Watu wanaougua COVID-19 wanapata dalili ndogo hadi wastani na hupona bila matibabu maalum.');
});	
$botman->hears('(.*)Dalili za (.*)', function ($bot) {
	$bot->reply('dalili za kawaida:homa, kikohozi kikavu,uchovu');
	$bot->reply('
		dalili zisizo za kawaida:
		1)Maumivu
		2)kuvimba koo
		3)kuharisha
		4)ugonjwa wa kikope
		5)maumivu ya kichwa
		6)kupoteza uwezo wa kuonja au kunusa
		7)upele kwenye ngozi, au kupoteza rangi ya vidole vya mikono au vya miguu');
	$bot->reply('Dalili hatari:
		1)kushindwa kupumua au kupungukiwa na pumzi
		2)shinikizo au maumivu ya kifua
	        3) kupoteza uwezo wa kuzungumza au kutembea');
});
$botman->hears('(.*) unaambukizwa|inaambukizwa|inasambaa|unasambaa (.*)', function ($bot) {
	$bot->reply('Watu wanaweza kupata Virusi vya Corona kutoka kwa watu walioambukizwa. Virusi vinaweza kusambaa kupitia maji maji kutoka kwenye pua au mdomo wa aliyeathirika. Iwapo mtu anagusa maji maji kama mafua, mate na makohozi ya mtu aliye na virusi na kisha kujigusa mdomo, macho na pua anaweza kupata virusi vya Corona.');

});
$botman->hears('(.*) vijana wadogo wanaweza kuambukizwa|kupata (.*)', function ($bot) {
	$bot->reply('Ndio, lakini uwezekano wao wa kufariki au kulazwa hospitalini ni mdogo');

});
$botman->hears('Kipindi cha kupevuka (.*)', function ($bot) {
	$bot->reply('Swali nzuri sana, kipindi cha kupevuka au kipindi ambacho dalili huonekana ni siku mbili hadi wiki mbili kutoka pale mtu anapoambukizwa kirusi hicho');

});
$botman->hears('(.*) ilianza wapi|ilianzia wapi|ilitokea wapi', function ($bot) {
        $bot->reply('Kesi za kwanza za maambukizo ya korona au covid 19 ziliripotiwa kwa mara ya kwanza nchini China, jijini Wuhan mnamo Disemba 2019.Asimilia kubwa 
                ya kesi hizo ziliripotiwa kutoka kwenye soko kuu la chakula la jumla jijini humo kusababisha soko hilo kufungwa mnamo Januari ,2020');

});
$botman->hears('Jinsi ya kujikinga (.*)', function ($bot) {
        $bot->reply('1:Nawa mkono mara kwa mara
                     2:Kujitenga na watu
                     3:Lishe bora
                     4:Epuka misongamano
                     5:Vaa barakoa');

});
$botman->hears('(.*) imeathiri|imeiathiri vipi dunia', function ($bot) {
        $bot->reply('Imeathiri dunia vikubwa sana haswa katika uchumi wa dunia.Kamati ya  maendeleo ya biashara ya Umoja wa Mataifa, UNCTAD, imesema virusi vya Corona au COVID-19, vimesababisha uzalishaji nchini China kusinyaa kwa asilimia 2 katika kipindi cha mwezi mmoja uliopita.');

});
$botman->hears('(.*) chanjo ya|Tiba ya (.*)|tiba corona|chanjo corona|tiba korona|chanjo korona|tiba|chanjo', function ($bot) {
	$bot->reply('Kuna chanjo kama vile:
	             1.AstraZeneca
	             2.Johnson&Johnson
	             3.Moderna
	             4.Pfizer	     ');

});


$botman->fallback(function($bot){
	$message=$bot->getMessage();
	$name=$bot->userStorage()->get('name');
	$bot->reply('Samahani '.$name.', sijakuelewa uliposema:"'.$message->getText().'"');
	$bot->reply('Jaribu maswali kama haya :');
	$bot->reply('Korona ni nini');
	$bot->reply('dalili za korona');
	$bot->reply('korona inaambukizwa vipi');
});
$botman->hears('Watu wangapi wameambukizwa na (.*) nchini {country}', function ($bot,  $country, $infected=infected) {
                $url='https://api.apify.com/v2/key-value-stores/Eb694wt67UxjdSGbc/records/LATEST?disableRedirect=true&q='.urlencode($infected);
                $response=json_decode(file_get_contents($url));
                $bot->reply('Waathiriwa corona nchini '.$country .' ni: '.$response->infected);
});
$botman->hears('Watu wangapi wamefariki kwa (.*) nchini {country}', function ($bot,  $country, $deceased=deceased) {
                $url='https://api.apify.com/v2/key-value-stores/Eb694wt67UxjdSGbc/records/LATEST?disableRedirect=true&q='.urlencode($deceased);
                $response=json_decode(file_get_contents($url));
                $bot->reply('Wafu wa corona nchini '.$country .' ni: '.$response->deceased);
});




$botman->hears('Start conversation', BotManController::class.'@startConversation');
