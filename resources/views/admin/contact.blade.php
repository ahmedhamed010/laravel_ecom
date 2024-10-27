@include('admin.header')

<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">All Messages</h2>
            </div>
        </div>

        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>View</th>
                        <th>Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{$contact->id}}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->phone}}</td>
                            <td class="view">
                                @if ($contact->view == 1)
                                    <span class="text-success">Read</span>
                                @else
                                    <span class="text-danger">UnRead</span>
                                @endif
                            </td>
                            
                            <td>
                                <!-- Link to view the message and mark it as read -->
                                <a href="{{ route('contacts.markAsRead', $contact->id) }}" class="btn btn-primary">
                                    View Message
                                </a>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="messageModal{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel{{$contact->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content bg-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="messageModalLabel{{$contact->id}}">Message from : {{$contact->name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{$contact->message}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>


    <script>
        $(document).ready(function() {
    $('.view-message-btn').on('click', function() {
        var contactId = $(this).data('id');
        var viewCell = $(this).closest('tr').find('.view');

        $.ajax({
            url: '/mark-as-read/' + contactId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.unreadCount !== undefined) {
                    // Change the status to "Read"
                    viewCell.text('Read');

                    // Update the unread messages count
                    $('.badge').text(response.unreadCount);
                }
            }
        });
    });
});

    </script>



    @include('admin.footer')
