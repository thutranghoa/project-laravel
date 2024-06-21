
<tbody>
    @if (count($results) > 0)
        @foreach($results as $result)
        <tr>
          <th scope="row">{{ $result->id }}</th>
          <td>{{ $result->user_id }}</td>
          <td>{{ $result->user ? $result->user->name : 'N/A' }}</td>
          <td>{{ $result->exam_id }}</td>
          <td>{{ $result->exercise ? $result->exercise->exercise_name : 'N/A' }}</td>
          <td>{{ $result->score }}</td>
          <td>{{ $result->exam_duration }}</td>
          <td>{{ $result->updated_at }}</td>
          <td>
            <button type="button" class="btn btn-danger delete-button" data-id="{{ $result->id }}" data-toggle="modal" data-target="#deleteStudentModal">
                Delete
            </button>
          </td>
        </tr>
        @endforeach
    @else
    <tr>
      <td colspan="9">No results found.</td>
    </tr>
    @endif
</tbody>
