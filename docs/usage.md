## Input Options

The following input options could be set in template variable settings:

Setting | Description | Default
------- | ----------- | -------
Allow Blank | If set to No, MODX will not allow the user to save the Resource until a valid, non-blank value has been entered in the From Date input. | Yes
Maximum Value | The maximum value of the time inputs. | 23:59
Minimum Value | The minimum value of the time inputs. | 00:00
Time Format | The format must be valid according to [Ext JS Date](https://docs.sencha.com/extjs/3.4.0/#!/api/Date) | System setting `manager_time_format`
Time Increment | The incremental number of minutes for the time lists | 60