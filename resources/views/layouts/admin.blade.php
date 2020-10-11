@include("inc.header")
@yield('css')

</head>

<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

@include("inc.top")

@include("inc.side")

@yield('content')

@include("inc.footer")
