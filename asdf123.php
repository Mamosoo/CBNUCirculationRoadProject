<?php
    error_reporting(E_ALL & ~E_NOTICE);
    $user_id=$_GET[user_id];
    $con=mysqli_connect("127.0.0.1","root","147852","db1");

    $query="SELECT name FROM `USER` WHERE id=$user_id";

    $cur=mysqli_query($con,$query);

    $result=array();
    $result[name]=mysqli_fetch_array($cur, MYSQLI_ASSOC)[name];

    $query="SELECT * FROM LOCATION WHERE user_id=$user_id";

    $cur=mysqli_query($con,$query);

    $result[data]=array();
    while($row=mysqli_fetch_array($cur,MYSQLI_ASSOC)){

        $result[data][]=$row;
    }
?>
<html>
<head>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDooj3Jzb19bxyetFND2wVL72bEsj7bVos"></script>
</head>
<script>

    google.maps.event.addDomListener(window, 'load', initialize);


    function showMap(lat, lng, info){
        console.log(info);
        var mapCanvas = document.getElementById('map-canvas');
        var myLatlng = new google.maps.LatLng(lat,lng);       // 위경도 설정
        var mapOptions = {          // 구글 맵 옵션
            center: myLatlng,
            zoom: 18,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // 구글 맵 생성
        var map = new google.maps.Map(mapCanvas, mapOptions);
        

        var contentString = '<div style="width:100px;height:50px;">'+info+'</div>';      // 말풍선 내용

        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            size: new google.maps.Size(100,100)
        });

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            draggable:false,            // 마커 드래그 가능
            title: 'Hello World!'   // 마커 : 도움말 풍선(마우스 오버 시)
        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);

            if (marker.getAnimation() != null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        });

        marker.setMap(map);
    
    }

</script>
</html>