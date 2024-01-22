<div class="table-responsive" style="overflow-x:hidden">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
        <div class="row">
            <div class="col-sm-12">
                <table id="dailytable"
                    class="table dailytable table-hover editTeamtable nowrap dataTable no-footer dtr-inline">
                    <thead>
                        <tr role="row">

                            <th style="text-align: center;">เลขที่สัญญา</th>
                            <th style="text-align: center;">ชื่อ-สกุล</th>

                            <th style="text-align: center;">ทีมตาม</th>
                            {{-- <th style="text-align: center;">ทีมตามใหม่</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $countEdit = 0;
                        @endphp
                        @foreach ($dataTeam as $i => $item)
                           
                            {{-- @if ($item->ViewComToTeamFollow != null) --}}
                                <tr>
                                    <td style="text-align: center;">{{ @$item->TeamFollowToCus->CON_NO }} </td>
                                    <td style="text-align: center;">{{ @$item->TeamFollowToCus->name }}
                                        {{ @$item->TeamFollowToCus->surname }}
                                    </td>
                                    <input type="hidden"class="form-control"
                                        value={{ $item->com_id }}
                                        name="com_id{{ $i + 1 }}"
                                        id="com_id{{ $i + 1 }}" required
                                        placeholder=" " />
                                    <td style="text-align: center;">
                                        <select class="form-select addOPR"
                                            id="id{{ $i + 1 }}"
                                            name="id{{ $i + 1 }}" required>

                                            @foreach (Auth::user()->get() as $key => $user)
                                        
                                                <option value="{{ $user->id }}"
                                                    {{ trim(@$item->user_id) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    {{-- <td style="text-align: center;">
                                        <select class="form-select addOPR"
                                            id="team{{ $i + 1 }}"
                                            name="team{{ $i + 1 }}" required>

                                            @foreach (Auth::user()->get() as $key => $user)
                                                <option value="{{ $user->id }}"
                                                    {{ trim(@$item->ViewComToTeamFollow->user_id) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </td> --}}
                                </tr>
                                @php
                                    $countEdit++;
                                @endphp
                           
                        @endforeach
                        <input type="text"class="d-none form-control" value={{ $countEdit }}
                            name="countEdit" id="countEdit" required placeholder=" " />
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>