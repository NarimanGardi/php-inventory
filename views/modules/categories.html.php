<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Categories

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Categories</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#addCategory">

          Add Category

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Categories</th>
              <th>Actions</th>

            </tr>

          </thead>

          <tbody>

            <tr>

              <td>1</td>

              <td>User Administrator</td>

              <div class="btn-group">
                <td>
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>

              </td>

            </tr>

            <tr>

              <td>1</td>

              <td>User Administrator</td>

              <div class="btn-group">
                <td>
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>

              </td>

            </tr>

            <tr>

              <td>1</td>

              <td>User Administrator</td>

              <div class="btn-group">
              <td>
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>

              </td>

            </tr>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>


<!--=====================================
=            module add Category            =
======================================-->

<!-- Modal -->
<div id="addCategory" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Add Category</h4>

        </div>

        <!--=====================================
        BODY
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--Input name -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input class="form-control input-lg" type="text" name="newCategory" placeholder="Add Category" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        FOOTER
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save</button>

        </div>

      </form>

    </div>

  </div>

</div>