<style>
    .container {
        margin: 20px auto;
        padding: 20px;
        background-color: #f7f7f7;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }

    .input-group {
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 20px;
        font-size: 16px;
    }

    .btn-outline-secondary {
        border-radius: 20px;
        font-size: 16px;
    }

    .pagination {
        justify-content: flex-end;
    }

    .page-item.disabled .page-link {
        background-color: #f7f7f7;
        border-color: #f7f7f7;
        color: #999;
        cursor: default;
    }

    .page-item .page-link {
        border-radius: 20px;
        color: #333;
        font-size: 16px;
    }

    .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .page-link:focus {
        box-shadow: none;
    }

    @media screen and (max-width: 576px) {
        .input-group {
            flex-direction: column;
        }

        .btn-outline-secondary {
            margin-top: 10px;
            width: 100%;
        }

        .pagination {
            justify-content: center;
        }
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">Search</button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>