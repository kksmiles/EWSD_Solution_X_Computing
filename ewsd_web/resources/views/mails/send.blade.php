<table>
        <tr>
            <th  style="
                background: blue;
                color: white;
                text-align: center;
                ">
                {{$title}}
            </th>
        </tr>
        <tr>
            <td>
                <span>Student Name</span>
            </td>
            <td>
                <span>{{ $student_name }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span>Student Mail (*you can reply to this mail)</span>
            </td>
            <td>
                <span>{{ $email }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span>Contribution Title</span>
            </td>
            <td>
                <span>{{ $msg_inbox }}</span>
            </td>
        </tr>
        <div>
            <h2>Hi, {{$contributor_name}}</h2>
            <p>You have to check this student contribution and reply before next 14 days from now on.</p>
            <p>If you don't reply within 14 days, this contribution will be rejected automatically</p>
            <p><a href="mailto:{{ $email }}">Email To student</a>  </p>
        </div>

        <div>
            Best Regards,
            <h2>SolutionX Team (EWSD)</h2>
        </div>
</table>