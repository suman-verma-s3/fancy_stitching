
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Branch Management</h5>
        </div>

        <div class="card-body">
            <form  method="POST"
            enctype="multipart/form-data">

            @csrf
 @method('PUT')
                <div class="row g-3">

                    <!-- Branch Name -->
                    <div class="col-md-6">
                        <label for="branch_name" class="form-label">
                            Branch Name <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control"
                               id="branch_name"
                               name="branch_name"
                               placeholder="Enter branch name"
                               required>
                    </div>

                    <!-- Branch Code -->
                    <div class="col-md-6">
                        <label for="branch_code" class="form-label">
                            Branch Code <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control"
                               id="branch_code"
                               name="branch_code"
                               placeholder="Enter branch code"
                               required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email"
                               class="form-control"
                               id="email"
                               name="email"
                               placeholder="Enter email address"
                               required>
                    </div>

                    <!-- Mobile Number -->
                    <div class="col-md-6">
                        <label for="mobile" class="form-label">
                            Mobile Number <span class="text-danger">*</span>
                        </label>
                        <input type="tel"
                               class="form-control"
                               id="mobile"
                               name="mobile"
                               placeholder="Enter mobile number"
                               maxlength="10"
                               required>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" name="sub_btn" class="btn btn-primary">
                        Save Branch
                    </button>

                  
                </div>

            </form>
        </div>
    </div>
</div>
   
</body>
</html>