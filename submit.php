<!DOCTYPE html>

<html>
<body>
    <form action="index.php" method="post">
        <select name="class" id="class">
            <option value="0">공지사항</option>
            <option value="1">업데이트</option>
        </select>

        제목<input type="text" name="title" /><br/><br/>
        글쓴이<input type="text" name="nickname"/><br/><br/>
        글내용<br/>

        <textarea name="content" id="content_text" rows="25" cols="93"></textarea><br/><br/>
        <input type="submit" name="submit" value="글쓰기" />
    </form>
</body>
</html>