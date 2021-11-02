<?php
error_reporting(-1);
ini_set('display_errors','On');

require __DIR__ . '/require.php';

xpc_catch();
$longfuk = 'Lorem ipsum dollor sit amet hello my friends muthafukerdf letz fuck it about manu inline';
//xpc_emerg($longfuk);

echo $bad;

xpc_arg('foo')
	->setShortName('h')
	->setLongName('host')
	->setDescription('Lorem muthafuckers ipsum and do fuck with its lee')
	->setDefaults('biz');


xpc_arg('boo')
	->setShortName('j')
	->setLongName('juba')
	->setDescription($longfuk);

xpc_arg('taboo')
	->setShortName('t')
	->setLongName('jubadubisnubi')
	->setDescription($longfuk);

$options = xpc_run();

var_dump($options->foo);

xpc_section('About',$longfuk);
xpc_outln (new XPC\XPCOptionStack);

xpc_status(XPC_OK,$longfuk);
xpc_status(XPC_FAIL,$longfuk);
xpc_status(XPC_INFO,$longfuk);
xpc_status(XPC_WARN,$longfuk);

$i = 0;
while ($i <= 100) {
	$m = md5(time()) . md5(time());
	$m = substr($m, 0,mt_rand(5,50));

	xpc_progress($i,1000,$m);
	xpc_clrln();
	
	$i = $i + 0.3;
	usleep(10000);
}

xpc_outln();

$i = 0;
while ($i <= 100) {
	$m = md5(time()) . md5(time());
	$m = substr($m, 0,mt_rand(5,50));

	xpc_spinner($m);
	xpc_clrln();

	$i++;
	usleep(100000);
}

xpc_outln();

$name = xpc_in('Hello? What\'s your name?');
xpc_outln('Hi ' . $name);

$pass = xpc_hidden_in('Pass');
xpc_outln('Tss: ' . $pass);