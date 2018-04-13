@extends('template')

@section('title', 'Previledge')
@section('content')

<section class="content">
    <div class="content-list" >
        <div class="tab-content">        
            <div role="tabpanel" class="tab-pane active" id="new">
              <div class="box-list">
                <div class="row">
                    <div class="col-md-6 pull-right">
                      <button type="button" class="btn btn-default pull-right" name="button">Tambah Akses</button>
                    </div>
                    <div class="col-md-6">
                        <select name="typeuser" class="form-control" id="typeuser" required>
                            <option value="">Pilih Tipe User</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="basic">Basic</option>
                            <option value="management">Management</option>
                            <option value="advance">Advance</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
              </div>
              <div class="box-list">
                  <div class="row">
                      <div class="col-sm-12">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Menu</th>
                              <th>Akses</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td></td>
                              <td>
                                <input type="checkbox" name="checked" :checked="(role.access === '1') ? 'checked' : ''" >
                              </td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                  </div>
              </div>
            </div>
    </div><!-- end: content tabs panes-->
</div>


    </section>

@endsection