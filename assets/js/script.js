$('#global-nav a[href*="#"]').click(function () {
    var elmHash = $(this).attr('href'); //ページ内リンクのHTMLタグhrefから、リンクされているエリアidの値を取得
    var pos = $(elmHash).offset().top;  //idの上部の距離を取得
    $('body,html').animate({scrollTop: pos}, 500); //取得した位置にスクロール。500の数値が大きくなるほどゆっくりスクロール
    return false;
  });

$(".serviceOther").slick({
    autoplay: true, // 自動でスクロール
    autoplaySpeed: 3000, // 自動再生のスライド切り替えまでの時間を設定
    dots: true,
    infinite: true,
    centerMode: true,
    centerPadding: "12%",
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
     {
        breakpoint: 768,
        settings: {
          centerMode: false,
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
        }
      } 
    ]
  });