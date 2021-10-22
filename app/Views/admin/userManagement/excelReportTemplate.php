<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
    <!--[if gte mso 9]>
			<xml>
				<x:ExcelWorkbook>
					<x:ExcelWorksheets>
						<x:ExcelWorksheet>
							<x:Name>Sheet 1</x:Name>
							<x:WorksheetOptions>
								<x:Print>
									<x:ValidPrinterInfo/>
								</x:Print>
							</x:WorksheetOptions>
						</x:ExcelWorksheet>
					</x:ExcelWorksheets>
				</x:ExcelWorkbook>
			</xml>
			<![endif]-->
</head>

<body>
    <?php 
    if(!isset($skipCol)){
        $skipCol = [];
    }
    ?>
<?php if(!empty($list)){ ?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <?php foreach($list[0] as $key=>$col){?>
                <?php if(!in_array($key,$skipCol)){?>
                <th><?=ucfirst(str_replace('_',' ',$key))?></th>
                <?php }?>
            <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($list as $key1=>$item){ ?>
        <tr>
            <td><?=$key1+1?></td>
        <?php foreach($item as $key=>$col){?>
            <?php if(!in_array($key,$skipCol)){?>
                <td><?=$col?></td>
                <?php }?>
        <?php }?>
            
        </tr>
<?php }?>
    </tbody>
</table>
 <?php } else{?>
    <table>
        <tbody>
            <tr>
                <td>No data avilable</td>
            </tr>
        </tbody>
    </table>
    <?php }?>
</body>

</html>