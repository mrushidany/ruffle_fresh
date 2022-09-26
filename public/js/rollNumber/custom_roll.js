  /*
  * æ·±åº¦è‡ªå®šä¹‰demo
  * å†…éƒ¨æ ·å¼ç»“æž„ï¼š._number > div > div > span
  * è¯¥demoåœ¨cssä¸­ï¼Œè‡ªå®šä¹‰äº†å†…éƒ¨ ._numberå’Œspançš„æ ·å¼
  */
 function run_draw(e){
  e.preventDefault();
  alert('okay');
  $diy = $('.number-diy .data');
  $diy.rollNumber({
    number: $diy[0].dataset.number, 
    speed: 700, 
    interval: 200,
    rooms: 10,
    space: 70,
    delay: 200,
    // symbol: ',', 
    fontStyle: {
      'font-size': '3.5rem',
      'font-family': 'LetsgoDigital',
    }
  });
}
  
  