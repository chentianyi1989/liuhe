<div class="swiper-container" id="swiper1">
	<div class="swiper-wrapper" style="height: 3.4rem">
		<a class="swiper-slide" href="#"> 
			<img src="/m/home/A01.jpg"
			alt="意空间" style="width: 100%;height: 100%"></a> 
		<a class="swiper-slide" href="#"> 
			<img src="/m/home/A02.jpg"
			alt="意空间" style="width: 100%;height: 100%"></a> 
		<a class="swiper-slide" href="#"> 
			<img src="/m/home/A03.jpg"
			alt="意空间" style="width: 100%;height: 100%"></a> 
		<a class="swiper-slide" href="#"> 
			<img src="/m/home/A04.jpg"
			alt="意空间" style="width: 100%;height: 100%"></a> 
	</div>
	<div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<script>
   var swiper = new Swiper('#swiper1', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
</script>