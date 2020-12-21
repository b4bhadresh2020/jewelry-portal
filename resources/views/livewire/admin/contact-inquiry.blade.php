
<div class="row">
    <div class="col s12">
        {{-- Load Filter--}}
        @include('admin.InquiryContact.filter')
        <div class="card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')===-1 || request('status')===null) active @endif" wire:click="changeStatus()" ><i class="material-icons left">dehaze</i> All Inquiry</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')===1) active @endif" wire:click="changeStatus(1)"><i class="material-icons left">check</i>Active Inquiry</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')=== 3) active @endif" wire:click="changeStatus(3)"><i class="material-icons left">do_not_disturb</i> Close Inquiry</a>
                    </li>
                </ul>
            </div>
            @if (count($inquiryInterface) != 0)
                <div class="card-content">
                    <div class="row" style="position: relative;">

                        <div class="col s12">
                            {{-- create table --}}
                            <table class="common-data-table bordered display striped nowrap">
                                <thead class="common-livewire-header">
                                    <tr>
                                        @if($bulkSelection)
                                            <td>
                                                <input type="checkbox" class="check-all tr dt-checkboxes">
                                            </td>
                                        @endif
                                        <th >First Name</th>
                                        <th>Last Name</th>
                                        <th width="100px">Email</th>
                                        <th width="100px">Phone</th>
                                        <th width="100px">Date</th>
                                        <th width="100px">Status</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>

                            <tbody class="table-tr-icons">
                                    @foreach ($inquiryInterface as $inquiry)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>{{ $inquiry->first_name }}</td>
                                            <td>{{ $inquiry->last_name }}</td>
                                            <td>{{ $inquiry->email }}</td>
                                            <td>{{ $inquiry->phone }}</td>
                                            <td>{{ date('d-M-Y',strtotime($inquiry->created_at)) }}</td>
                                            @if ($inquiry->status==1)
                                                <td> <span class="chip green lighten-5"><span class="green-text">Active</span></span></td>
                                            @elseif($inquiry->status==2)
                                                <td> <span class="chip red lighten-5"><span class="red-text">Replied</span></span></td>
                                            @elseif($inquiry->status==3)
                                                <td> <span class="chip red lighten-5"><span class="red-text">Cancel</span></span></td>
                                            @endif
                                            <td>
                                                {{-- class="modal-trigger" href="#modal1" href="#reply"--}}
                                                <a class='dropdown-trigger' data-target='dropdown{{ $inquiry->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $inquiry->id }}' class='dropdown-content'>
                                                    @if($inquiry->status!=3)
                                                    <li> <a wire:click="replyInquiry('{{ $inquiry->id }}')" ><i class="material-icons dp48">reply</i>Reply </a></li>
                                                    @endif
                                                    <li> <a wire:click="viewMessage('{{ $inquiry->id }}')"  ><i class="material-icons dp48">visibility</i> View Message</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Load common Pagination --}}
                            @include('admin.partials.default-table-pagination',[
                                'tblData' => $inquiryInterface,
                                'livewire' => true
                            ])
                        </div>
                        {{-- Load liveWire Loading --}}
                        @include('admin.partials.wire-loading')
                    </div>
                </div>
            @else
                <div class="dnf-ui-card">
                    <div class="center-align">
                        <img width="40%" src="{{ url('assets/img/dnf-ui.jpg') }}">
                        <h4 class="dnf-ui-title">Sorry,
                            @if(request('status')===-1 || request('status')===null)
                                All
                            @elseif(request('status')===1)
                                Active
                            @elseif(request('status')===3)
                                Close
                            @endif
                            Inquiry Not Found..
                        </h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{-- Modal Data --}}
    @if ($this->inquiryContact)
        <div id="modal1" class="modal" style="width: 45%; !imporatant;">
            <div class="modal-content">
                @if($defaultValue==1)
                    <h5 class="mb-3">Contact Inquiry</h5>
                    <div class="row ml-1 box" >
                        <h6><i class="material-icons dp48  mr-1 size">message</i><b>Inquiry Message</b></h6>
                            <p>{{ $this->inquiryContact['message'] }}</p>
                            <h6><i class="material-icons dp48 mr-1 size">reply</i><b> Reply Message</b></h6>
                            <p>{{ $this->inquiryContact['reply'] }}</p>
                    </div>
                @endif
                @if($defaultValue==0)
                    <h5 class="mb-3">Inquiry Reply</h5>
                    <div class="row" >
                        <form class="col s12 box pb-2" id="replyInquiry">
                            <input type="hidden" id="inquiryId" value="{{$this->inquiryContact['id']}}">
                            <div class="row  p-2">
                                <h6><i class="material-icons dp48  mr-1 size">message</i><b>Inquiry Message</b></h6>
                                <div class="col s12 ">
                                    <p>{{ $this->inquiryContact['message'] }}</p>
                                </div>
                                @if($this->inquiryContact['reply']!=null)
                                    <h6><i class="material-icons dp48 mr-1 size">reply</i><b> Reply Message</b></h6>
                                    <div class="col s12 ">
                                        <p>{{ $this->inquiryContact['reply'] }}</p>
                                    </div>
                                @endif
                            </div>
                            @if($this->inquiryContact['reply']==null)
                                <div class="row mt-1">
                                    <div class="input-field col s12 row">
                                        <textarea id="reply"  class="materialize-textarea" ></textarea>
                                        <label for="">Reply</label>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-sm-6 left-align ml-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>
                                                <input type="checkbox" name="notification"/>
                                                <span> Send Notification</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>
                                                    <input type="checkbox" name="status" class="closeinquiry" value="3"/>
                                                    <span>Close Inquiry</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 right-align mr-2" style="margin-top: -34px;">
                                        <button class="btn cyan waves-effect waves-light" type="submit">Submit
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>

                                </div>
                            @endif
                        </form>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>
    @endif
</div>

