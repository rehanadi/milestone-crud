<?php
include("config.php");

$name = "";
$email = "";
$password = "";
$phone = "";
$gender = "";
$address = "";
$is_update = false;
$id = 0;

// Insert user
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $conn->query("INSERT INTO users (name, email, password, phone, gender, address) VALUES ('$name', '$email', '$password', '$phone', '$gender', '$address')");
    header("Location: index.php");
}

// Edit user
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $is_update = true;
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    if ($result->num_rows) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $gender = $row['gender'];
        $address = $row['address'];
    }
}

// Update user
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $conn->query("UPDATE users SET name='$name', email='$email', password='$password', phone='$phone', gender='$gender', address='$address' WHERE id=$id");
    header("Location: index.php");
}

// Delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container w-75 pb-5">
    <h2 class="mt-4">Users</h2>

    <!-- User Form -->
    <form action="index.php" method="POST" class="mt-4">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger fw-bold">*</span></label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger fw-bold">*</span></label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-danger fw-bold">*</span></label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone <span class="text-danger fw-bold">*</span></label>
            <input type="number" name="phone" class="form-control" value="<?php echo $phone; ?>" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender <span class="text-danger fw-bold">*</span></label>
            <select name="gender" class="form-select" required>
                <option value="">- Select Gender -</option>
                <option value="M" <?php echo ($gender == 'M') ? 'selected' : ''; ?>>Male</option>
                <option value="F" <?php echo ($gender == 'F') ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address <span class="text-danger fw-bold">*</span></label>
            <textarea name="address" class="form-control" required><?php echo $address; ?></textarea>
        </div>
        <?php if ($is_update == true): ?>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
        <?php else: ?>
            <button type="submit" name="save" class="btn btn-success">Save</button>
        <?php endif; ?>
    </form>

    <!-- User Table -->
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=1;
            $result = $conn->query("SELECT * FROM users");
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php $no++; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>