<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>خطأ</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <a class="btn btn-primary btn-lg w-100 d-block" href="{{ route('your.route.name') }}">رجوع</a>
                </div><br>
                <form id="yourForm" autocomplete="yes" enctype="multipart/form-data"
                    action="{{ route('your.store.route') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row g-3 mb-20">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="orderInput">الترتيب</label>
                                <input name="order" type="number" class="form-control" id="orderInput" placeholder="أدخل الترتيب">
                                @error('order')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="genderSelect">الجنس</label>
                                <select name="gender" class="custom-select" id="genderSelect">
                                    <option value="ذكر">ذكر</option>
                                    <option value="انثى">أنثى</option>
                                </select>
                                @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-20">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="teachingPlaceSelect">مكان التدريس</label>
                                <select name="teachingPlace" class="custom-select" id="teachingPlaceSelect">
                                    <option value="اكاديمية و منصة">أكاديمية ومنصة</option>
                                    <option value="منصة">منصة</option>
                                </select>
                                @error('teachingPlace')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="accountsSelect">الحسابات</label>
                                <select name="accounts" class="custom-select" id="accountsSelect">
                                    <option value="يومى">يومي</option>
                                    <option value="شهرى">شهري</option>
                                </select>
                                @error('accounts')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-20">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="accountsMethodSelect">طريقة الحسابات</label>
                                <select name="accountsMethod" class="custom-select" id="accountsMethodSelect">
                                    <option value="اعتيادى">اعتيادي</option>
                                    <option value="استثنائى">استثنائي</option>
                                </select>
                                @error('accountsMethod')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="subjectIdSelect">الموضوع</label>
                                <select name="subjectId" class="custom-select" id="subjectIdSelect">
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subjectId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-20">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="gradeIdSelect">الدرجة</label>
                                <select name="gradeId" class="custom-select" id="gradeIdSelect">
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('gradeId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="classroomIdSelect">الفصل الدراسي</label>
                                <select name="classroomId" class="custom-select" id="classroomIdSelect">
                                    @foreach($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                                @error('classroomId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-20">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="branchIdsInput">أرقام الفروع</label>
                                <textarea name="branchIds" class="form-control" id="branchIdsInput" placeholder="أدخل أرقام الفروع"></textarea>
                                @error('branchIds')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="classroomsIdsInput">أرقام الفصول الدراسية</label>
                                <textarea name="classroomsIds" class="form-control" id="classroomsIdsInput" placeholder="أدخل أرقام الفصول الدراسية"></textarea>
                                @error('classroomsIds')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-20">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="personalPhoneNumberInput">رقم الهاتف الشخصي</label>
                                <input name="personalPhoneNumber" type="number" class="form-control" id="personalPhoneNumberInput" placeholder="أدخل رقم الهاتف الشخصي">
                                @error('personalPhoneNumber')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <label for="personalWhatsappNumberInput">رقم واتس آب الشخصي</label>
                                <input name="personalWhatsappNumber" type="number" class="form-control" id="personalWhatsappNumberInput" placeholder="أدخل رقم واتس آب الشخصي">
                                @error('personalWhatsappNumber')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-20">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <button type="submit" class="btn btn-primary d-block col-12">إضافة</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
