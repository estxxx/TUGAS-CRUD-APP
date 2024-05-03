<?php
class Post {
    static function select($id='') {
        global $conn;
        $sql = "SELECT * FROM tbposts";
        if ($id!='') {
            $sql .= " WHERE id = $id";
        }
        $result = $conn->query($sql);
        $rows = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        $result->free();
        $conn->close();
        return $rows;
    }

    static function insert($data=[]) {
        extract($data);
        global $conn;
        $inserted_at = date('Y-m-d H:i:s', strtotime('now'));
        $sql = "INSERT INTO tbposts SET title = ?, content = ?, date = ?, category = ?, image = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $title, $content, $date, $category, $image);
        $stmt->execute();

        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }

    static function update($data=[]) {
        extract($data);
        global $conn;
        $updated_at = date('Y-m-d H:i:s', strtotime('now'));
        $sql = "UPDATE tbposts SET title = ?, content = ?, date = ?, category = ?, image = ?, WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssi', $title, $content, $date, $category, $image, $id);
        $stmt->execute();

        $result = $stmt->affected_rows > 0 ? true : false;
        $conn->close();
        return $result;
    }

    static function delete($id='') {
        global $conn;
        $result = '';
        $deleted_at = date('Y-m-d H:i:s', strtotime('now'));
        if ($id == '') {
            $sql = "UPDATE tbposts SET deleted_at = '$deleted_at'";
            $result = $conn->query($sql);
        }
        else {
            $sql = "UPDATE tbposts SET deleted_at = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $deleted_at, $id);
            $stmt->execute();
    
            $result = $stmt->affected_rows > 0 ? true : false;
        }
        return $result;
    }

    static function rawQuery($sql) {
        global $conn;
        $result = $conn->query($sql);
        $rows = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        $result->free();
        $conn->close();
        return $rows;
    }
}