<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td><p>Dear <strong> {{$name}},</strong></p></td>
        </tr>
        <tr>
          <td valign="middle" style="line-height:23px;"><p>{{$text}}</p></td>
        </tr>
        <tr>
          <td>Please click on the link to login <a href="{{url('/admin')}}">Click Here</a></td>
        </tr>
        <tr>
          <td>Your login details are as following</td>
        </tr>
        <tr>
          <td>Username: <a href="javascript:void(0)">{{$to}}</a></td>
        </tr>
        <tr>
          <td>Password: {{$password}}</td>
        </tr>
        <tr>
          <td>Regards</td>
        </tr>
        <tr>
          <td>Outplacement Team</td>
        </tr>
      </tbody>
</table>