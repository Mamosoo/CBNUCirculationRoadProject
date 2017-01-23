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
    <link rel="stylesheet" href="main.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDooj3Jzb19bxyetFND2wVL72bEsj7bVos"></script>
</head>
<body onLoad="pagestart()">
    <div class="whole_box">
        <div class="left_box" style="width: 600px; float: left">
            <div class="left_top">
                <div class="left_top_left"><a href="/Hackathon_login_complete"><img src="logofinal.png" width="100%" height="100%"/></a></div>
                <div class="left_top_right">전북대학교 둘레길 위치 안내&nbsp;<p>&nbsp;<?php echo $result[name]; ?> 님이<br><br>접속중 입니다.</div>
            </div>
            <div class="left_bottom">
                <table>
                    <tr>
                        <th>시&nbsp; &nbsp; 간</th>
                        <th>위도</th>
                        <th>경도</th>
                        <th>이름</th>
                        <th>이동</th>
                        <th><a href=http://localhost:8080/submit.php 주소><input type = "button" value = "인증서체출"></a></th>

                        
                    </tr>
                    <?php foreach($result[data] as &$asd) {?>
                    <tr>
                        <td><?php echo $asd[time];?></td>
                        <td><?php echo $asd[lat];?></td>
                        <td><?php echo $asd[lng];?></td>
                        <td><?php echo $asd[locname];?></td>
                        
                        <td><button style="width: 50px; height: 20px;> type="button" onclick="showMap(<?php echo $asd[lat]?>, <?php echo $asd[lng]?>,'<?php echo $asd[info]?>')"></button></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <div id="right_box">
            <div id="map-canvas" style="width: heigt background-color: #000" ></div>
        </div>
    </div>
</body>
<script>
    function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var myLatlng = new google.maps.LatLng(35.8152217,127.147597);       // 위경도 설정
        var mapOptions = {          // 구글 맵 옵션
            center: myLatlng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // 구글 맵 생성
        var map = new google.maps.Map(mapCanvas, mapOptions);

       // var contentString = '<div style="width:50px;height:50px;">경기전</div>';     // 말풍선 내용

        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            size: new google.maps.Size(50,50)
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