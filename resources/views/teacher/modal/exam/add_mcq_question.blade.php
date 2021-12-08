    <!-- Modal for add question-->
    <div class="modal fade" id="mcqExamModal" tabindex="-1" role="dialog" aria-labelledby="mcqExamModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mcqExamModalLabel">Add MCQ Questions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher.addMCQQuestion') }}" method="POST" enctype="multipart/form-data"
                        class="question-form">
                        @csrf
                        <input type="hidden" name="exam_id" id="exam_id">
                        <div id="dynamicAddRemoveMCQ">
                            <div class="form-group">
                                <label for="question"><b>Question<span class="text-danger">*</span></b></label>
                                <textarea cols="2" name="addMoreInputFields[0][question]" rows="2"
                                    class="form-control"></textarea>
                                <span class="textarea_error text-danger"></span>
                            </div>
                            <div class="form-group">

                                <label for="image"><b>Image</b></label>
                                <input type="file" class="form-control-file" name="addMoreInputFields[0][image]">
                                <span class="file_error text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="options"><b>Options</b></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Option 1<span class="text-danger">*</span></label>
                                        <input type="text" name="addMoreInputFields[0][option][]" class="form-control">
                                        <span class="option_1_err text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Option 2<span class="text-danger">*</span></label>
                                        <input type="text" name="addMoreInputFields[0][option][]" class="form-control">
                                        <span class="option_2_err text-danger"></span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label for="">Option 3<span class="text-danger">*</span></label>
                                        <input type="text" name="addMoreInputFields[0][option][]" class="form-control">
                                        <span class="option_3_err text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Option 4<span class="text-danger">*</span></label>
                                        <input type="text" name="addMoreInputFields[0][option][]" class="form-control">
                                        <span class="option_4_err text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""><b>Right Answer<span class="text-danger">*</span></b></label>
                                        <input type="text" name="addMoreInputFields[0][answer]" class="form-control">
                                        <span class="answer_err text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="button" name="add" id="dynamic-ar-mcq" class="btn btn-primary mt-3"><i
                                    class="fa fa-plus"></i></button>
                            <button type="submit" class="btn btn-primary float-right mt-3" id="btn_mcq_submit">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
