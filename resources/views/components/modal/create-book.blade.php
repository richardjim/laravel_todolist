<div>

    <!-- Modal -->
    <div class="modal fade modal-xl" id="addNewBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{route('books.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="bookCover">Cover</label>
                            <input type="file" name="cover" class="form-control" id="bookCover">
                        </div>

                        <div class="form-group">
                            <label for="bookTitle">Book Title</label>
                            <input type="text" name="title" class="form-control" id="bookTitle">

                        </div>
                        <div class="form-group">
                            <label for="bookPrice">Price</label>
                            <input type="text" name="price" class="form-control" id="bookPrice">

                        </div>
                        <div class="form-group">
                            <label for="bookContent">Details</label>
                            <textarea name="content" class="form-control" id="bookContent" cols="30" rows="10"></textarea>

                        </div>
                        <div class="form-group">
                            <label for="year_published">Year Published</label>
                            <input type="text" name="year_published" class="form-control" id="year_published">

                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
</div>