<tbody id="messageList">
    @foreach ($messages as $message)
        <tr class="message">
            <td>
                <div class="icheck-primary">
                    <input type="checkbox" value="{{ $message->id }}" id="check{{ $message->id }}">
                    <label for="check{{ $message->id }}"></label>
                </div>
            </td>
            <td class=" text-center mailbox-star">
                <a href="#">
                    @if ($message->favorite != null)
                        <div class="favorite-icon-delete" data-message-id="{{ $message->favorite->id }}">
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    @else
                        <div class="favorite-icon" data-message-id="{{ $message->id }}">
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    @endif
                </a>
            </td>
            <td class=" text-center mailbox-name">
                <a class="btn btn-light" href="{{ route('inbox.show', $message->id) }}">من :
                    {{ $message->toUser->email }} </a>
            </td>
            <td class=" text-center mailbox-subject overflow-hidden">
                <a class="btn btn-light " href="{{ route('inbox.show', $message->id) }}">فتح الرسالة</a>
            </td>
            <td class="text-center">
            @if ($message->seen == 0)
                    <span class="badge bg-danger text-white text-bold">لم يتم قراءتها</span>
                    @elseif($message->seen == 1)
                    <span class="badge bg-success text-white text-bold">تم قرائتها </span>

            @endif

        </td>
            <td class="mailbox-date text-center">
                {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</td>
        </tr>
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
                aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel">
                                حذف الرسالة</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        هل انت متاكد من حذف الرسالة ؟
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="button" class="btn btn-danger" id="confirmDelete">حذف</button>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
</tbody>
